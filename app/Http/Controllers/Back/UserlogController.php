<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserlogController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('developer'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userlogs_by_date = DB::table('v_userlogs')->orderBy('created_at', 'desc')->get()->groupBy('date');

        return view('back.userslog.index', compact('userlogs_by_date'));
    }

    public function stats()
    {
        abort_if(Gate::denies('developer'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userstats = DB::table('v_userstats')->get();

        $records = $data = [];

        foreach ($userstats as $userstat) {
            $records['label'][] = $userstat->country_name;
            $records['data'][] = $userstat->users;
        }

        $data['chart_data'] = json_encode($records);

        return view('back.userslog.stats', $data);
    }
}
