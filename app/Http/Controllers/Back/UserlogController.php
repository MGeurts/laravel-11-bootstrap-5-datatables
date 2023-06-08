<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Userlog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserlogController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('developer'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userlogs_by_date = Userlog::with('user')
            ->where('country_code', '!=', 'BE')
            ->where('created_at', '>=', carbon::now()->subMonths(3))
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('date');

        return view('back.userslog.index', compact('userlogs_by_date'));
    }

    public function stats()
    {
        abort_if(Gate::denies('developer'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userstats = Userlog::select('country_name', DB::raw('count(*) as users'))
            ->where('country_code', '!=', 'BE')
            ->whereNotNull('country_name')
            ->groupBy('country_name')
            ->get();

        $records = $data = [];

        foreach ($userstats as $userstat) {
            $records['label'][] = $userstat->country_name;
            $records['data'][] = $userstat->users;
        }

        $data['chart_data'] = json_encode($records);

        return view('back.userslog.stats', $data);
    }

    public function statsPeriodic()
    {
        switch (session('APP.PERIOD')) {
            case 'year':
                $statistics = Userlog::select(DB::raw('YEAR(created_at) as `period`'), DB::raw('count(*) as `visitors`'))
                    ->where('country_code', '!=', 'BE')
                    ->whereNotNull('country_name')
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get();

                break;
            case 'month':
                $statistics = Userlog::select(DB::raw('LPAD(MONTH(`created_at`), 2, 0) AS `period`'), DB::raw('count(*) as `visitors`'))
                    ->where('country_code', '!=', 'BE')
                    ->whereNotNull('country_name')
                    ->whereYear('created_at', session('APP.YEAR'))
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get();

                break;
            case 'week':
                $statistics = Userlog::select(DB::raw('LPAD(WEEK(`created_at`, 0), 2, 0) AS `period`'), DB::raw('count(*) as `visitors`'))
                    ->where('country_code', '!=', 'BE')
                    ->whereNotNull('country_name')
                    ->whereYear('created_at', session('APP.YEAR'))
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get();

                break;
            case 'day':
                $statistics = Userlog::select(DB::raw('DATE_FORMAT(`created_at`, "%Y-%m-%d") AS `period`'), DB::raw('count(*) as `visitors`'))
                    ->where('country_code', '!=', 'BE')
                    ->whereNotNull('country_name')
                    ->whereYear('created_at', session('APP.YEAR'))
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get();

                break;
        }

        $records = $data = [];

        foreach ($statistics as $statistic) {
            $records['label'][] = $statistic->period;
            $records['data'][] = $statistic->visitors;
        }

        $data['chart_data'] = json_encode($records);

        return view('back.userslog.stats-periodic', $data);
    }
}
