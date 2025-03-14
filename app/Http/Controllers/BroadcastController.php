<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\BroadcastEvent;
use App\Models\Channel;
use App\Models\Text;

class BroadcastController extends Controller
{
    public function centralMessages() {
        return view('index');
    }

    public function chat(Request $request) {
        $ch1 = Channel::where('name', 'ch.'.$request->fromuser.'.'.$request->touser)->first();
        $ch2 = Channel::where('name', 'ch.'.$request->touser.'.'.$request->fromuser)->first();
        $channelName = '';

        if($ch1) {
            $channelName = $ch1->name;
        } elseif($ch2) {
            $channelName = $ch2->name;
        } else {
            try {
                $ch3 = Channel::create([
                    'name' => 'ch.'.$request->fromuser.'.'.$request->touser,
                ]);
                $channelName = $ch3->name;
            } catch(\Exception $e) {
                dd($e);
            } 
        }

        return view('index', ['channelname' => $channelName, 'fromuser' => $request->fromuser, 'touser' => $request->touser]);
    }

    public function broadcast(Request $request ) {
        broadcast(new BroadcastEvent($request->message, $request->user_name, $request->channelname))->toOthers();
        try {
            Text::create([
                'fromuser' => $request->fromuser,
                'touser' => $request->touser,
                'content' => $request->message,
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
        return view('broadcast', ['message' => $request->message, 'user_name' => $request->user_name]);
    }

    public function receive(Request $request ) {
        return view('receive', ['message' => $request->message, 'user_name' => $request->user_name]);
    }
}
