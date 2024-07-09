<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function userpage01(Request $request) {
        return view('userpage01', ['token' => $request->token]);
    }
}
