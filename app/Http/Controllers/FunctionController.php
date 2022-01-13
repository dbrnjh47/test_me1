<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use App\User;
use Response;
use App;

class FunctionController extends Controller
{   

    public function info_user_secondary_save(Request $r){
        $true = 2;
        $confirmation_email = $this->user->confirmation_email;
        $confirmation_telephone = $this->user->confirmation_telephone;

        if($r->email && !stripos($r->email, "*") && !preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $r->email) || $r->email && str_replace('*','',$r->email) == ""){
            $true = "Email введен не корректно!";
        }

        if($r->telephone && !stripos($r->telephone, "*") && !preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $r->telephone) || $r->telephone && str_replace('*','',$r->telephone) == ""){
            $true = "Телефон введен не корректно!";
        }

        if(!$r->login){
            $true = "Никнейм обязателен для заполнения!";
        }

        if($r->login && $r->login && strlen($r->login) < 3 || $r->login && strlen($r->login) > 10){
            $true = "Новый никнейм не может быть меньше 3 символов или больше 10 символов!";
        }

        if($r->gender && $r->gender != "Ж" && $r->gender != "М"){
            $true = "Пол не определён!";
        }

        if(!stripos($r->email, "*") && preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $r->email) && User::where('email', $r->email)
                    ->count() != 0){
            $true = "Почта уже занят!";
        }

        if(!stripos($r->email, "*") && preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $r->email) && User::where('email', $r->email)
                    ->count() == 0){
            $confirmation_email = 0;
        }

        if(!stripos($r->telephone, "*") && preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $r->telephone) && User::where('telephone', $r->telephone)
                    ->count() != 0){
            $true = "Телефон уже занят!";
        }

        if(!stripos($r->telephone, "*") && preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $r->telephone) && User::where('email', $r->telephone)
                    ->count() == 0){
            $confirmation_telephone = 0;
        }

        if($true != 2){
            return response()->json([
                'success' => false,
                'error' => $true
            ]);
        }

        User::where('id', $this->user->id)->update([
            'email' => (stripos($r->email, "*") || $r->email[0] == "*" ? $this->user->email : $r->email),
            'telephone' => (stripos($r->telephone, "*") || $r->telephone[0] == "*" ? $this->user->telephone : $r->telephone),
            'address' => (stripos($r->address, "*") || $r->address[0] == "*" ? $this->user->address : $r->address),
            'surname' => (stripos($r->surname, "*") || $r->surname[0] == "*" ? $this->user->surname : $r->surname),
            'name' => (stripos($r->name, "*") || $r->name[0] == "*" ? $this->user->name : $r->name),
            'patronymic' => (stripos($r->patronymic, "*") || $r->patronymic[0] == "*" ? $this->user->patronymic : $r->patronymic),
            'login' => $r->login,
            'index_address' => (stripos($r->index_address, "*") || $r->index_address[0] == "*" ? $this->user->index_address : $r->index_address),
            'date_of_birth' => Carbon::parse($r->date_of_birth),
            'city' => $r->city,
            'gender' => $r->gender,
            'confirmation_email' => $confirmation_email,
            'confirmation_telephone' => $confirmation_telephone,
        ]);

        return response()->json([
            'success' => true,
            'error' => "Данные обновлены!",
        ]);
    }
    
    public function update_avatar(Request $r){
        if($r->file('img') == null){
            return response()->json([
                'success' => false,
                'error' => "Файл не найден!"
            ]);
        }
        
        if(filesize($r->file('img')) > 700000){
            return response()->json([
                'success' => false,
                'error' => "Размер файла не может превышать 0.7 МБ!"
            ]);
        }
        $image = $r->file('img');
        $form = $image->getClientOriginalExtension();
        if($form != 'jpg' && $form != 'png' && $form != 'jpeg'){
            return response()->json([
                'success' => false,
                'error' => "Неверный формат файла!"
            ]);
        }
        $new_name = rand() . '.' . $form;
        $Content = array();

        $image->move(public_path('temple/imgs/avatar/'), $new_name);
        
        $Content['name'] = $new_name;
        $Content['url'] = "/temple/imgs/avatar/".$new_name;

        User::where('id', $this->user->id)->update([
            'avatar' => $Content['url'],
        ]);

        return response()->json([
            'success' => true,
            'error' => "Аватарка обновлена!",
            'src' => $Content['url']
        ]);
    }

    public function promo_activ(Request $r){
        if (\Cache::has('BET.' . $this->user->id)) {
            return response()->json([
                'success' => false,
                'error' => "Нельзя так часто активировать промокод!"
            ]);
        }
        \Cache::put('BET.' . $this->user->id, '', 5.04);

        if($this->user->ban_promo){
            return response()->json([
                'success' => false,
                'error' => "Вы заблокированы в активации промокодов!"
            ]);
        }

        $promo = \DB::table('promo')->where('name', $r->promo)->first();
        if(!$promo){
            return response()->json([
                'success' => false,
                'error' => "Промокод не найден!"
            ]);
        }

        if(!$promo->col || $promo->status){
            return response()->json([
                'success' => false,
                'error' => "Активации закончились!"
            ]);
        }
        
        $status = "Ошибка, обратитесь в поддержку!";

        switch ($promo->function) {
            case 'balance_replenishment':
                $this->user->balance += $promo->sum;
                $this->user->save();
                $status = 0;
                break;
        }

        \DB::table('promo')->where('id', $promo->id)->update([
                'col' => ($promo->col-1)
            ]);

        if($status){
            return response()->json([
                'success' => false,
                'error' => $status
            ]);
        }

        switch ($promo->function) {
            case 'balance_replenishment':
                return response()->json([
                    'success' => true,
                    'error' => "Код активирован!",
                    'balance_user' => $this->user->balance
                ]);
                break;
        }
    }

    public function provider_activ(Request $r){
        if($r->provider == "*"){
            $slots = DB::table('slots')->get();
        } else {
            $slots = DB::table('slots')->where('provider', $r->provider)->get();
        }
        if($slots == "[]"){
            return response()->json([
                'success' => false,
                'error' => "Провайдер не найден!"
            ]);
        }

        return response()->json([
            'success' => true,
            'error' => "",
            'slots' => $slots
        ]);
    }

    public function search_slots(Request $r){
        if($r->provider == "*"){
            $slots = DB::table('slots')->where('title', 'like', '%'.$r->search.'%')->get();
        } else {
            $slots = DB::table('slots')->where('title', 'like', '%'.$r->search.'%')->where('provider', $r->provider)->get();
        }

        if($slots == "[]"){
            return response()->json([
                'success' => false,
                'error' => "Слоты не найдены!"
            ]);
        }

        return response()->json([
            'success' => true,
            'error' => "",
            'slots' => $slots
        ]);
    }

    public function submit_Verification(Request $r){
        // if (\Cache::has('BET.' . $this->user->id)) {
        //     return response()->json([
        //         'success' => false,
        //         'error' => "Заявку можно отправлять раз в минуту!"
        //     ]);
        // }
        // \Cache::put('BET.' . $this->user->id, '', 60.04);
        if($r->file('img') == null){
            return response()->json([
                'success' => false,
                'error' => "Файл не найден!"
            ]);
        }

        $input_name = 'img';
        $allow = array(
            'jpg', 'png', 'jpeg'
        );

        $files = array();
        $diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);

        if ($diff == 0) {
        $files = array($_FILES[$input_name]);
        } else {
            foreach($_FILES[$input_name] as $k => $l) {
               foreach($l as $i => $v) {
                    $files[$i][$k] = $v;
                }
            }       
        }   
        $filesize = 0;
        foreach ($files as $file) {
            $name = time()-rand();
            $parts = pathinfo($file['name']);
            
            if (empty($name) || empty($parts['extension'])) {
                return response()->json([
                    'success' => false,
                    'error' => "Недопустимый тип файла!"
                ]);
            } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                return response()->json([
                    'success' => false,
                    'error' => "Недопустимый тип файла!"
                ]);
            } else {
                $filesize += filesize($file['tmp_name']);
                if($filesize > 10000000){
                    return response()->json([
                        'success' => false,
                        'error' => "Размер файла(ов) не может превышать 10 МБ!"
                    ]);
                }

                move_uploaded_file($file['tmp_name'], public_path('temple/imgs/Verification_test/') .$name.".".$parts['extension']);
                
                
            }
        }

        return response()->json([
            'success' => true,
            'error' => "Файлы загружены!"
        ]);
    }

    public function setting_alerts(Request $r){

        if($r->email_distribution == null || $r->sms_distribution == null || $r->bonus_distribution == null){
            return response()->json([
                'success' => false,
                'error' => "Данные не найдены!"
            ]);
        }

        User::where('id', $this->user->id)->update([
                'bonus_alerts' => $r->bonus_distribution,
                'sms_alerts' => $r->sms_distribution,
                'email_alerts' => $r->email_distribution,
            ]);

        return response()->json([
            'success' => true,
            'error' => "Подписка обновлена!"
        ]);
    }
    
    public function change_password(Request $r){
        if (\Cache::has('BET.' . $this->user->id)) {
            return response()->json([
                'success' => false,
                'error' => "Нельзя так часто делать запрос!"
            ]);
        }
        \Cache::put('BET.' . $this->user->id, '', 5.04);

        if($this->user->password != $r->old_password){
            return response()->json([
                'success' => false,
                'error' => "Пароль не верен!"
            ]);
        }

        if($r->new_password != $r->new_password_repeat){
            return response()->json([
                'success' => false,
                'error' => "Пароли не совпадают!"
            ]);
        }

        if($r->new_password == null || strlen($r->new_password) < 5 || strlen($r->new_password) > 15){
            return response()->json([
                'success' => false,
                'error' => "Пароль не может быть меньше 5 или больше 15 символов!"
            ]);
        }

        User::where('id', $this->user->id)->update([
                'password' => $r->new_password_repeat,
            ]);

        return response()->json([
            'success' => true,
            'error' => "Пароль изменён!"
        ]);
    }
}
