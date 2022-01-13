<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use DB;
use App\Experience_telegrams;
use App\Experience_telegrams_user;
use App\Experience_telegrams_user_distribution;
use App\Experience_telegrams_user_history;
use Response;
use App;

class TelegramController extends Controller
{   
    public function __construct()
    {
      $this->Experience_telegrams = Experience_telegrams::first();
      $this->user = null;
      $this->method = null;
    }
    const token = "5024838801:AAHMgJk4lZMS1SnnkhOu64edYIl6I2VnGDg";
    
    public function index() {
        
		$content = file_get_contents("php://input");
        $data = json_decode($content, true);

        if(isset($data['callback_query']))
            $data = $data['callback_query'];
        if(isset($data['message']))
            $data = $data['message'];

        if(!isset($data['text'])){
            return;
        }

        $message = mb_strtolower(($data['text'] ? $data['text']
            : $data['data']) , 'utf-8' );
        $this->method = 'sendMessage';

        Log::debug(json_encode($data));

        $this->new_user($data);
        $this->user = Experience_telegrams_user::where('telegrams_chat_id', $data['chat']['id'])
                            ->orWhere('telegrams_user_id', $data['from']['id'])->first();

        switch ($message){
            case '/start':
                $send_data = [
                    'text'=>'Привет, курс доллара '. $this->Experience_telegrams->course
                ];
                $this->history($data['from']['id']);
                break;
            case '/subscribe':
                $send_data = $this->subscribe();
                break;
            case '/history_user':
                $send_data = $this->history_user();
                break;
            default:
                return;
        }

        $send_data['chat_id']=$data['chat']['id'];
        return $this->sendTelegram($this->method,$send_data);
	}
    
    public function new_user($data){
        if(Experience_telegrams_user::where('telegrams_chat_id', $data['chat']['id'])
                            ->orWhere('telegrams_user_id', $data['from']['id'])
                            ->count() == 0){
            Experience_telegrams_user::insert([
                    'name' => (isset($data['from']['first_name']) ? $data['from']['first_name'] : "none"), 
                    'telegrams_chat_id' => $data['chat']['id'], 
                    'telegrams_user_id' => $data['from']['id']]); 
        }
    }

    public function history_user(){
        $history_user = Experience_telegrams_user_history::where('telegrams_user_id', $this->user->telegrams_user_id)->get();

        if(json_encode($history_user) == "[]"){
            return [
                'text'=>'Упс, мы ничего не нашли!'
            ];
        } else {
            $send_data['text'] = "История пользователя ".$this->user->name." \n";
            $send_data['text'] .= "Курс  Дата запроса \n";
            foreach ($history_user as $key => $h) {
                $send_data['text'] .= $h->course."₽ ".$h->created_at." \n";
            }
            return [
                'text'=>$send_data['text']
            ];
        }
    }

    public function subscribe(){
        if(Experience_telegrams_user_distribution::where('id_user', $this->user->id)
                    ->count() != 0){
            return [
                'text'=> $this->user->name.', Вы уже подписаны!'
            ];
        } else {
            Experience_telegrams_user_distribution::insert([
            'id_user' => $this->user->id]);
            return [
                'text'=> $this->user->name.', Вы подписались на минутную рассылку!'
            ];
        }
    }

    public function history($telegrams_user_id){
        Experience_telegrams_user_history::insert([
                    'telegrams_user_id' => $telegrams_user_id, 
                    'course' => $this->Experience_telegrams->course]);
    }

    public static function sendTelegram($method, $data, $headers=[]){
        $handle = curl_init("https://api.telegram.org/bot".self::token."/{$method}");
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_HEADER, 0);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($handle, CURLOPT_HTTPHEADER,
            array_merge( array("Content-Type: application/json"),
                $headers ) );
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($handle, CURLOPT_TIMEOUT, 60);

        $result = curl_exec($handle);
        curl_close($handle);
        return ( json_decode($result,1) ? json_decode($result,1) :
            $result);
    }
}