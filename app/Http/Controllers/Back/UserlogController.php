<?php

namespace App\Http\Controllers\Back;

use App\Countries;
use App\Http\Controllers\Controller;
use App\Models\Userlog;
use Illuminate\Support\Carbon;

class UserlogController extends Controller
{
    public function index($months = 3)
    {
        $userlogs_by_date = Userlog::query()
            ->select('userlogs.country_name', 'userlogs.country_code', 'userlogs.created_at', 'users.name', 'users.is_developer')
            ->leftjoin('users', 'userlogs.user_id', '=', 'users.id')
            ->where('userlogs.user_id', '!=', 2)
            ->where('userlogs.created_at', '>=', carbon::now()->startOfMonth()->subMonths($months))
            ->orderBy('userlogs.created_at', 'desc')
            ->get()
            ->groupBy('date');

        return view('back.userslog.index')->with([
            'userlogs_by_date' => $userlogs_by_date,
            'months' => $months,
        ]);
    }

    public function statsCountry()
    {
        $statistics = Userlog::select('country_name')
            ->selectRaw('COUNT(*) AS visitors')
            ->where('user_id', '!=', 2)
            ->whereNotNull('country_name')
            ->groupBy('country_name')
            ->orderBy('visitors', 'desc')->orderBy('country_name')
            ->get();

        $chart_data = json_encode([
            'label' => $statistics->pluck('country_name'),
            'data' => $statistics->pluck('visitors'),
        ]);

        return view('back.userslog.stats-country')->with([
            'chart_data' => $chart_data,
        ]);
    }

    public function statsCountryMap()
    {
        $countries = (new Countries(app()->getLocale()))->getCountryNamesForSvgMap();

        $data = Userlog::select('country_code')
            ->selectRaw('COUNT(*) AS visitors')
            ->groupBy('country_code')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item->country_code => [
                        'visitors' => $item->visitors,
                    ],
                ];
            })->toArray();

        return view('back.userslog.stats-country-map', compact('countries', 'data'));
    }

    public function statsPeriod()
    {
        $statistics = match (session('APP.PERIOD')) {
            'year' => Userlog::selectRaw('YEAR(created_at) AS period')
                ->selectRaw('COUNT(*) AS visitors')
                ->where('user_id', '!=', 2)
                ->groupBy('period')
                ->orderBy('period')
                ->get(),
            'month' => Userlog::selectRaw('LPAD(MONTH(created_at), 2, 0) AS period')
                ->selectRaw('COUNT(*) AS visitors')
                ->where('user_id', '!=', 2)
                ->whereYear('created_at', session('APP.YEAR'))
                ->groupBy('period')
                ->orderBy('period')
                ->get(),
            'week' => Userlog::selectRaw('LPAD(WEEK(created_at, 1), 2, 0) AS period')
                ->selectRaw('COUNT(*) AS visitors')
                ->where('user_id', '!=', 2)
                ->whereYear('created_at', session('APP.YEAR'))
                ->groupBy('period')
                ->orderBy('period')
                ->get(),
            'day' => Userlog::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") AS period')
                ->selectRaw('COUNT(*) AS visitors')
                ->where('user_id', '!=', 2)
                ->whereYear('created_at', session('APP.YEAR'))
                ->groupBy('period')
                ->orderBy('period')
                ->get()
        };

        $chart_data = json_encode([
            'label' => $statistics->pluck('period'),
            'data' => $statistics->pluck('visitors'),
        ]);

        return view('back.userslog.stats-period')->with([
            'chart_data' => $chart_data,
        ]);
    }
}
