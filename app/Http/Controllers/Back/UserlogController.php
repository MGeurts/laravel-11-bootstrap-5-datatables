<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Userlog;
use Illuminate\Support\Carbon;
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

        $userstats = Userlog::select('country_name')
            ->selectRaw('count(*) as users')
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
        $statistics = match (session('APP.PERIOD')) {
            'year' => Userlog::selectRaw('YEAR(created_at) as period')
                ->selectRaw('count(*) as `visitors`')
                ->where('user_id', '!=', 2)
                ->groupBy('period')
                ->orderBy('period')
                ->get(),
            'month' => Userlog::selectRaw('LPAD(MONTH(created_at), 2, 0) AS period')
                ->selectRaw('count(*) as visitors')
                ->where('user_id', '!=', 2)
                ->whereYear('created_at', session('APP.YEAR'))
                ->groupBy('period')
                ->orderBy('period')
                ->get(),
            'week' => Userlog::selectRaw('LPAD(WEEK(created_at, 0), 2, 0) AS period')
                ->selectRaw('count(*) as visitors')
                ->where('user_id', '!=', 2)
                ->whereYear('created_at', session('APP.YEAR'))
                ->groupBy('period')
                ->orderBy('period')
                ->get(),
            'day' => Userlog::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") AS period')
                ->selectRaw('count(*) as visitors')
                ->where('user_id', '!=', 2)
                ->whereYear('created_at', session('APP.YEAR'))
                ->groupBy('period')
                ->orderBy('period')
                ->get()
        };

        $records = $data = [];

        foreach ($statistics as $statistic) {
            $records['label'][] = $statistic->period;
            $records['data'][] = $statistic->visitors;
        }

        $data['chart_data'] = json_encode($records);

        return view('back.userslog.stats-periodic', $data);
    }
}
