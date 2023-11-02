<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Userlog;
use Illuminate\Support\Carbon;
use Khill\Lavacharts\Lavacharts;

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
        $countries = Userlog::select('country_code')
            ->selectRaw('MIN(country_name) AS country_name')
            ->selectRaw('COUNT(*) AS visitors')
            ->where('user_id', '!=', 2)
            ->whereNotNull('country_code')
            ->groupBy('country_code')
            ->get();

        $data = $countries->map(function ($country) {
            return [
                [
                    $country->country_code, // v:
                    $country->country_name, // f:
                ],
                $country->visitors,
            ];
        })->toArray();

        $lava = new Lavacharts([
            // This is a fake Google API key, replace it with your own legal Google API key !!
            'maps_api_key' => '23ay5t987354inr28m9crg893crgt9arc98tr2a896tarc2896ta28',
            // The key is only needed for markers, not used in this example !!
        ]);

        $visitors = $lava->DataTable()
            ->addStringColumn('Country')
            ->addNumberColumn('Visitors')
            ->addRows($data);

        $lava->GeoChart('Visitors', $visitors, [
            'colorAxis' => ['minValue' => 0,  'colors' => ['#BCD2E8', '#1E3F66']],   // ColorAxis Options
            'datalessRegionColor' => '#d0d0d0',
            'displayMode' => 'auto',
            'enableRegionInteractivity' => true,
            'keepAspectRatio' => true,
            'region' => 'world',
            'magnifyingGlass' => ['enable' => true, 'zoomFactor' => 7.5],            // MagnifyingGlass Options
            'markerOpacity' => 1.0,
            'resolution' => 'countries',
            'sizeAxis' => null,
            'backgroundColor' => '#f0f0f0',
            'geochartVersion' => 11,
            'regioncoderVersion' => 1,
        ]);

        return view('back.userslog.stats-country-map')->with([
            'lava' => $lava,
        ]);
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
