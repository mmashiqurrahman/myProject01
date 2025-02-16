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
        broadcast(new BroadcastEvent($request->message, $request->user_name))->toOthers();
        return view('broadcast', ['message' => $request->message, 'user_name' => $request->user_name]);
    }

    public function receive(Request $request ) {
        return view('receive', ['message' => $request->message, 'user_name' => $request->user_name]);
    }
}
