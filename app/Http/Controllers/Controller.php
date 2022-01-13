<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Redis;
use App\User;
use App\Settings;
use Cookie;
use Session;
use Mail;
// use Illuminate\Support\Facades\Notification;
// use App\Notifications\SMS;
use Nexmo;

class Controller extends BaseController
{   
    protected $user;
    public function __construct()
    {
        $this->settings = Settings::first();
        date_default_timezone_set('Europe/Moscow');

        $this->middleware(function ($request, $next) {
            $teh_works = $this->settings->teh_work;
            $this->user = Auth::user();
            if(Auth::user() && $this->user->role != "admin" &&  $this->user->ban){
               return response()->view('pages.ban');
            }
            if(Auth::user() && $this->user->role == "admin"){
                $teh_works = 0;
            }
            if($teh_works){
                return response()->view('pages.teh_work');
            }

            $this->user = Auth::user();
            view()->share('u', $this->user);
            
            return $next($request);
        }); 
        view()->share('settings', $this->settings);
        view()->share('currency', \DB::table('currency')->get());
        $locale = Cookie::get('locale');
        view()->share('locale', $locale);
        App::setLocale($locale);
    }

    public function locale(Request $r){
        if (! in_array($r->locale, ['en', 'ru', 'fr', 'pa', 'id', 'in', 'ch'])) {
            return response()->json([
                'success' => false,
                'error' => 'Язык не найден!'
            ]);
        }

        setcookie("locale", $r->locale, time()+(525600*60));
        // Cookie::queue('locale', $r->locale, 525600);
        return response()->json([
            'success' => true,
            'error' => ''
        ]);
    }

    public function login(Request $r){
        if($r->password == "" || $r->email == ""){
            return response()->json([
                'success' => false,
                'error' => "Данные не введены!",
                'input' => ["email", "pass"]
            ]);
        }

        $email_true = 1;
        if(preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $r->email)){
            $email_true = 0;
        } 

        if(preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $r->email) && $email_true){
            $email_true = 0;
            if(preg_match('/\+7?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $r->email)){
                $r->email = substr($r->email, 1);
                $num = substr($r->email, 0, 1) + 1;
                $r->email = $num.substr($r->email, 1);
            }
        }

        if($email_true){
            return response()->json([
                'success' => false,
                'error' => "Данные введены неверно!",
                'input' => ["email"]
            ]);
        }

        $user = User::where('email', $r->email)
                    ->where('password', $r->password)
                    ->orWhere('telephone', $r->email)
                    ->where('password', $r->password)->first();
        if(!$user){
            return response()->json([
                'success' => false,
                'error' => "Данные введены неверно!",
                'input' => ["email", "pass"]
            ]);
        }

        Auth::login($user, true);
        return response()->json([
            'success' => true,
            'error' => ''
        ]);
    }

    public function signup(Request $r){
        $true = 2;
        $input = null;
        $email = 0;
        if($r->password == null){
            $true = "Вы не ввели пароль!";
            $input = ["email", "pass"];
            // $true = __('Controller.enter_your_password');
        }
        if(strlen($r->password) < 5 || strlen($r->password) > 15){
            $true = "Пароль не может быть меньше 5 или больше 15 символов!";
            $input = ["pass"];
        }
        if(strlen($r->name) < 5 || strlen($r->name) > 15){
            $true = "никнейм не может быть меньше 5 или больше 15 символов!";
            $input = ["name"];
        }
        if($r->email == null || User::where('email', $r->email)
                    ->orWhere('telephone', $r->email)
                    ->count() != 0){
            $true = "Вы не ввели почту/телефон или он уже занят!";
            $input = ["email"];
        }
        if(preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $r->email)){
            $email = 1;
        } else if(!preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $r->email)){
            $true = "Поле Ваш email/телефон введены не корректно!";
            $input = ["email"];
        }
        if($r->currency == null || \DB::table('currency')->where('name', $r->currency)->count() == 0){
            $true = "Выберите другую валюту!";
            $input = ["currency"];
        }

        if($r->years != "true") {
            $true = "Согласитесь с правилами и политикой!";
            $input = ["years"];
        }

        if($true != 2){
            return response()->json([
                'success' => false,
                'error' => $true,
                'input' => $input
            ]);
        }

        if(preg_match('/\+7?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $r->email)){
            $r->email = substr($r->email, 1);
            $num = substr($r->email, 0, 1) + 1;
            $r->email = $num.substr($r->email, 1);
        }

        $code = '';
        $arr = array(
             'A','B','C','D','E','F',
             'G','H','I','J','K','L',
             'M','N','O','P','R','S',
             'T','U','V','X','Y','Z',
             '1','2','3','4','5','6',
             '7','8','9','0');
        for($i = 0; $i < 10; $i++) {
            $index = rand(0, count($arr) - 1);
            $code .= $arr[$index];
        }

        if(preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $r->email)){
        $user = \DB::table('users')->insert([
            'password' => $r->password, 
            'ip' => $this->getIp(), 
            'code_ref' => $code,
            'currency' => $r->currency,
            'login' => $r->name,
            'activated_ref' => (!is_null(Session::get('ref'))) ? Session::get('ref') : null, 
            'data_ref' => (!is_null(Session::get('ref'))) ? Carbon::now() : null,
            'email' => $r->email]);
        $user = User::where('email', $r->email)->where('password', $r->password)->first();
        } else {
        $user = \DB::table('users')->insert([
            'password' => $r->password, 
            'ip' => $this->getIp(), 
            'code_ref' => $code,
            'login' => $r->name,
            'currency' => $r->currency,
            'activated_ref' => (!is_null(Session::get('ref'))) ? Session::get('ref') : null, 
            'data_ref' => (!is_null(Session::get('ref'))) ? Carbon::now() : null,
            'telephone' => $r->email]);
        $user = User::where('telephone', $r->email)->where('password', $r->password)->first();
        }

        if($r->notifications == "true") {
            $notifications = \DB::table('notifications')->insert(['id_user' => $user->id]);
        }

        Auth::login($user, true);

        return response()->json([
            'success' => true,
            'error' => ''
        ]);
    }

    public function check_pass(Request $r){
        if(preg_match('/\+7?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $r->email)){
            $r->email = substr($r->email, 1);
            $num = substr($r->email, 0, 1) + 1;
            $r->email = $num.substr($r->email, 1);
        }
        $user = User::where('code', $r->code)->where('email', $r->email)->orWhere('telephone', $r->email)->where('code', $r->code)->first();
        if(!$user){
            return response()->json([
                'success' => false,
                'error' => "Код не верен!"
            ]);
        }
        
        return response()->json([
            'success' => true,
            'error' => 'Введите новый пароль!'
        ]);
    }

    public function check_pass_next(Request $r){
        if(preg_match('/\+7?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $r->email)){
            $r->email = substr($r->email, 1);
            $num = substr($r->email, 0, 1) + 1;
            $r->email = $num.substr($r->email, 1);
        }
        $user = User::where('code', $r->code)->where('email', $r->email)->orWhere('telephone', $r->email)->where('code', $r->code)->first();
        if(!$user){
            return response()->json([
                'success' => false,
                'error' => "Код не верен!"
            ]);
        }

        User::where('code', $r->code)->where('email', $r->email)->orWhere('telephone', $r->email)->where('code', $r->code)->update([
                'password' => $r->pass
            ]);
        $user = User::where('code', $r->code)->where('email', $r->email)->orWhere('telephone', $r->email)->where('code', $r->code)->first();
        Auth::login($user, true);
        
        return response()->json([
            'success' => true,
            'error' => ''
        ]);
    }

    protected $user_info_email;
    public function reset(Request $r){
        if(!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $r->email)){
            return response()->json([
                'success' => false,
                'error' => "Ваш email введен не корректно!"
            ]);
        }
        
        $this->user_info_email = User::where('email', $r->email)->first();
        if(!$this->user_info_email){
            return response()->json([
                'success' => false,
                'error' => "Неверный адрес электронной почты!"
            ]);
        }

        $array = array(rand(1000,9999),rand(1000,9999),rand(1000,9999),rand(1000,9999));
        $code = implode("-", $array);
        User::where('email', $r->email)->update([
                'code' => $code
            ]);
        
        Mail::send(['html' => 'email.recovery_mail'], 
            [   
                'login' => $this->user_info_email->login,
                'code' => $code,
                'settings' => $this->settings
            ],
            function($message){
                $message->to($this->user_info_email->email, $this->user_info_email->login)->subject('Восстановление пароля '.$this->settings->project_name);
                    $message->from(env('MAIL_USERNAME'), $this->settings->project_name);
            }
        );
        return response()->json([
            'success' => true,
            'error' => "Вам отправили письмо на электронную почту",
        ]);
    }

    public function recovery_telephone(Request $r){
        if(!preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $r->email)){
            return response()->json([
                'success' => false,
                'error' => "Поле Ваш телефон введен не корректно!"
            ]);
        }
        
        if(preg_match('/\+7?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $r->email)){
            $r->email = substr($r->email, 1);
            $num = substr($r->email, 0, 1) + 1;
            $r->email = $num.substr($r->email, 1);
        }
        
        $user_info_email = User::where('telephone', $r->email)->first();
        if(!$user_info_email || $r->email == ""){
            return response()->json([
                'success' => false,
                'error' => "Неверный телефон!"
            ]);
        }
        $array = array(rand(1000,9999),rand(1000,9999),rand(1000,9999),rand(1000,9999));
        $code = implode("-", $array);
        User::where('telephone', $r->email)->update([
                'code' => $code
            ]);

        Nexmo::message()->send([
            'to' => $r->email,
            'from' => $this->settings->project_name,
            'text' => 'Code: '.$code
        ]);
        // Notification::send($user_sms, new SMS);
        return response()->json([
            'success' => true,
            'error' => "Вам отправили код на телефон!",
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function getIp()
    {
        if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
            $ip=$_SERVER['HTTP_X_REAL_IP'];
        }
        elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
