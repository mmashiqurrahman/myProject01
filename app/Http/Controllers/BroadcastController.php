<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\BroadcastEvent;

class BroadcastController extends Controller
{
    public function centralMessages() {
        return view('index');
    }

    public function broadcast(Request $request ) {
        broadcast(new BroadcastEvent($request->get('message')))->toOthers();
        return view('broadcast', ['message' => $request->get('message')]);
    }

    public function receive(Request $request ) {
        return view('receive', ['message' => $request->get('message')]);
    }
}
