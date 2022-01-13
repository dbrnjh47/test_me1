<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'password','role','avatar','login', 'email', 'balance', 'ref_balance', 'all_ref', 'code_ref', 'activated_ref'
    ];

    protected $hidden = [ 'remember_token'];

    static function findRef($id) {
		$user = \DB::table('users')->select('id', 'login', 'avatar', 'activated_ref')->where('activated_ref', $id)->first();
		return $user;
	}
    static function Plans($id) {
        $plans = \DB::table('plans')->where('id', $id)->first();
        return $plans;
    }
}
