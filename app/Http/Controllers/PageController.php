<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Redis;
use App\User;
use Response;
use Lang;
use App;
use Session;
class PageController extends Controller
{	
	public function home($dynamics = null)
    {
        $slots = DB::table('slots')->get();
        $providers = DB::table('slots')->select('provider')->distinct()->get();

        return view('pages.home', compact('dynamics', 'slots', 'providers', 'recommended_slots', 'recommended_slots_sidebar'));
    }

    public function profile($dynamics = null)
    {
    	$level = \DB::table('level')->where('level', $this->user->level)->first();
    	$level_next = \DB::table('level')->where('level', ($this->user->level+1))->first();
        return view('pages.profile', compact('dynamics', 'level', 'level_next'));
    }

    public function home_ref($r){
        if(User::where('code_ref', $r)->first()) {Session::put('ref', $r); return redirect('/');};
        return abort(404);
    }

    public function demoSlot($identifier, $dynamics = null)
    {
        $slot = DB::table('slots')->where('id', $identifier)->first();
        if(!$slot) return response("Slot don't found");

        $client = new \GuzzleHttp\Client();
        $response = $client->post(
            'http://127.0.0.1:3000/api/slot/demo',
            [
                \GuzzleHttp\RequestOptions::JSON => 
                ['identifier' => $slot->identifier]
            ],
            ['Content-Type' => 'application/json']
        );

        $responseJSON = json_decode($response->getBody());
        // if(!property_exists('responseJSON', 'url')) return response("Произошла техническая ошибка");
        if(!property_exists($responseJSON, 'url'))  return response("Произошла техническая ошибка");
        // if(!$responseJSON->url) {
        //     return response("Произошла техническая ошибка");
        // }
        $game_url = $responseJSON->url;
        return view('pages.slot', compact('dynamics', 'slot', 'game_url'));
    }

    public function realSlot($identifier, $dynamics = null)
    {
        $slot = DB::table('slots')->where('id', $identifier)->first();
        if(!$slot) return response("Slot don't found");

        $client = new \GuzzleHttp\Client();
        $response = $client->post(
            'http://127.0.0.1:3000/api/slot/real',
            [
                \GuzzleHttp\RequestOptions::JSON => 
                [
                    'identifier' => $slot->identifier,
                    'user' => Auth::user()
                ]
            ],
            ['Content-Type' => 'application/json']
        );

        $responseJSON = json_decode($response->getBody());
        if(!property_exists($responseJSON, 'url'))  return response("Произошла техническая ошибка");
        $game_url = $responseJSON->url;
        return view('pages.slot', compact('dynamics', 'slot', 'game_url'));
    }

}
