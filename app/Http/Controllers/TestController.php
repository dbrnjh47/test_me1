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
use Resposen;
use Lang;
use App;

class TestController extends Controller
{	
	public function index() {
        return view('pages.test');
    }

    public function play() {
        return response()->json([
            "balance" => 1000,
        ]);
    }
}
