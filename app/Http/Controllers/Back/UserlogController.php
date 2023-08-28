<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Userlog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Khill\Lavacharts\Lavacharts;
use Symfony\Component\HttpFoundation\Response;

class UserlogController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('developer'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userlogs_by_date = Userlog::query()
            ->select('userlogs.country_name', 'userlogs.country_code', 'userlogs.created_at', 'users.name', 'users.is_developer')
            ->leftjoin('users', 'userlogs.user_id', '=', 'users.id')
            ->where('userlogs.user_id', '!=', 2)
            ->where('userlogs.created_at', '>=', carbon::now()->startOfMonth()->subMonths(3))
            ->orderBy('userlogs.created_at', 'desc')
            ->get()
            ->groupBy('date');

        return view('back.userslog.index', compact('userlogs_by_date'));
    }

    public function statsCountry()
    {
        abort_if(Gate::denies('developer'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statistics = Userlog::select('country_name')
            ->selectRaw('count(*) as visitors')
            ->where('user_id', '!=', 2)
            ->whereNotNull('country_name')
            ->groupBy('country_name')
            ->orderBy('visitors', 'desc')
            ->orderBy('country_name')
            ->get();

        $data['chart_data'] = json_encode([
            'label' => $statistics->pluck('country_name'),
            'data' => $statistics->pluck('visitors'),
        ]);

        return view('back.userslog.stats-country', $data);
    }

    public function statsCountryMap()
    {
        abort_if(Gate::denies('developer'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Userlog::select('country_code AS country_code')
            ->selectRaw('MIN(country_name) AS `country_name`')
            ->selectRaw('COUNT(*) AS `visitors`')
            ->where('user_id', '!=', 2)
            ->whereNotNull('country_code')
            ->groupBy('country_code')
            ->get()
            ->toArray();

        $data = [];

        foreach ($countries as $country) {
            array_push($data, [
                [
                    $country['country_code'], // v:
                    $country['country_name'], // f:
                ],
                $country['visitors'],
            ]);
        }

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

        return view('back.userslog.stats-country-map', compact('lava'));
    }

    public function statsPeriode()
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

        $data['chart_data'] = json_encode([
            'label' => $statistics->pluck('period'),
            'data' => $statistics->pluck('visitors'),
        ]);

        return view('back.userslog.stats-periode', $data);
    }
}
