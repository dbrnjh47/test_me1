<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Settings extends Model
{
	protected $table = 'settings';
	public $timestamps = false;

	static function currency($currency) {
		$currency = \DB::table('currency')->where('name', $currency)->first();
		return $currency;
	}
}
