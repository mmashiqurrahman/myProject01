<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestPageController extends Controller
{
    public function guestpage01() {
        return view('guestpage01');
    }

    public function guestpage01post(Request $request) {
        dd($request);
    }
}
