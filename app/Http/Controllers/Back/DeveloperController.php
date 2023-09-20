<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function hashGenerator(Request $request)
    {
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
