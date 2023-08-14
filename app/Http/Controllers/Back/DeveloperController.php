<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DeveloperController extends Controller
{
    public function hashGenerator(Request $request)
    {
        abort_if(Gate::denies('developer'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $value = $request->value ? $request->value : '';
        $hash = password_hash($value, PASSWORD_DEFAULT);

        return view('back.developer.hash-generator', compact('value', 'hash'));
    }

    public function impressum()
    {
        return view('back.developer.impressum');
    }

    public function session()
    {
        return view('back.developer.session');
    }

    public function test(Request $request)
    {
        return view('back.developer.test');
    }
}
