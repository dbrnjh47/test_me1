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
use App\Settings;
use Response;
use Lang;
use App;

class AdminController extends Controller
{   
    public function index() {
		$pay_today = \DB::table('payments')->where('updated_at', '>=', Carbon::today())->where('status', 1)->sum('sum');
		$pay_week = \DB::table('payments')->where('updated_at', '>=', Carbon::now()->subDays(7))->where('status', 1)->sum('sum');
		$pay_month = \DB::table('payments')->where('updated_at', '>=', Carbon::now()->subDays(30))->where('status', 1)->sum('sum');
		$pay_all = \DB::table('payments')->where('status', 1)->sum('sum');
        $with_req = \DB::table('withdraw')->where('status', 0)->orderBy('id', 'desc')->sum('sum');
        $usersCount = User::count();
		
		$profit = \DB::table('bonus_history')->where('created_at', '>=', Carbon::today())->sum('sum');
		$profit_ref = \DB::table('bonus_history')->where('name_function', 'Реф. система')->where('created_at', '>=', Carbon::today())->sum('sum');

		$users = User::orderBy('id', 'desc')->limit(10)->get();
        $userTop = User::where('role', '!=', 'admin')->where('balance', '!=', 0)->orderBy('balance', 'desc')->limit(20)->get();
        
        $payments = \DB::table('payments')->where('status', 1)->orderBy('id', 'desc')->limit(15)->get();
		$withdraw = \DB::table('withdraw')->orderBy('id', 'desc')->limit(25)->get();

		$last_withdraw = [];
		foreach($withdraw as $d) {
            $user = User::where('id', $d->user_id)->first();
            $last_withdraw[] = [
                'id' => $user->id,
                'login' => $user->login,
                'avatar' => $user->avatar,
                'sum' => $d->sum,
                'date' => $d->updated_at,
                'status' => $d->status,
            ];
        }
        $last_dep = [];
        foreach($payments as $d) {
            $user = User::where('id', $d->user_id)->first();
            $last_dep[] = [
                'id' => $user->id,
                'login' => $user->login,
                'avatar' => $user->avatar,
                'sum' => $d->sum,
                'date' => $d->updated_at
            ];
        }
		
		return view('admin.index', compact('pay_today', 'pay_week', 'pay_month', 'pay_all', 'with_req', 'usersCount', 'profit', 'profit_ref', 'last_dep', 'users', 'userTop', 'last_withdraw'));
    }

    public function getUserByMonth() {
		$chart = User::select(DB::raw('DATE_FORMAT(created_at, "%d.%m") as date'), DB::raw('count(*) as count'))
			->whereMonth('created_at', '=', date('m'))
			->groupBy('date')
			->get();
		
		return $chart;
	}

	public function getDepsByMonth() {
		$chart = \DB::table('payments')->where('status', 1)->select(DB::raw('DATE_FORMAT(created_at, "%d.%m") as date'), DB::raw('SUM(sum) as sum'))
			->whereMonth('created_at', '=', date('m'))
			->groupBy('date')
			->get();
		
		return $chart;
	}

    public function payments() {
        $list = \DB::table('payments')->whereIn('status', [0, 3])->orderBy('id', 'desc')->get();
        $payments = [];
        foreach($list as $itm) {
            $user = User::where('id', $itm->user_id)->first();
            $payments[] = [
                'id' => $itm->id,
                'user_id' => $user->id,
                'username' => $user->login,
                'avatar' => $user->avatar,
                'comment' => $itm->comment,
                'sum' => $itm->sum,
                'system' => $itm->name_cash
            ];
        }
        

        
        return view('admin.payments', compact('payments'));
    }

    public function paymentsAjax() {
        return datatables(\DB::table('payments')->get())->toJson();
    }

	public function users() {
		return view('admin.users');
    }

    public function usersAjax() {
        return datatables(User::query())->toJson();
    }

    public function user($id) {
        $user = User::where('id', $id)->first();
		$pay = \DB::table('payments')->where('user_id', $user->id)->where('status', 1)->sum('sum');
		$withdraw = \DB::table('withdraw')->where('user_id', $user->id)->where('status', 1)->sum('sum');


		return view('admin.user', compact('user', 'pay', 'withdraw')); 
    }

    public function settings() {
        $calc_plan = \DB::table('calc_plan')->get();
        return view('admin.settings', compact('calc_plan')); 
    }

    public function settingsSave(Request $r) {
        Settings::where('id', 1)->update([
            'project_name' => $r->project_name,
            'days_working' => $r->days_working,
            'show_review' => $r->show_review,
            'sum_payments' => $r->sum_payments,
            'sum_withdraw' => $r->sum_withdraw,
            'telephone' => $r->telephone,
            'email' => $r->email,
            'address' => $r->address,
            'ref_given' => $r->ref_given,
            'ref_conclusion' => $r->ref_conclusion,
            'min_refill' => $r->min_refill,
            'max_refill' => $r->max_refill,
            'lvl0' => $r->lvl0,
            'lvl1' => $r->lvl1,
            'lvl2' => $r->lvl2,
            'lvl3' => $r->lvl3,
            'withdrawal_min' => $r->withdrawal_min,
            'withdrawal_max' => $r->withdrawal_max,
            'partners' => $r->partners,
            'youtube' => $r->youtube,
            'instagram' => $r->instagram,
            'facebook' => $r->facebook,
            'twitter' => $r->twitter,
            'id_video_home' => $r->id_video_home,
            'support_chat' => $r->support_chat,
            'withdraw' => $r->withdraw,
            'teh_work' => $r->teh_work,
            ]);

        \DB::table('calc_plan')->where('id', 1)->update([
            'cost' => $r->cost_1,
            ]);

        \DB::table('calc_plan')->where('id', 2)->update([
            'cost' => $r->cost_2,
            ]);

        \DB::table('calc_plan')->where('id', 3)->update([
            'cost' => $r->cost_3,
            ]);
        return redirect()->route('admin.settings')->with('success', 'Настройки сохранены!');
    }
    public function userSave(Request $r) {
        $data_ref = null;
        $banchat = null;
        if($r->get('id') == null) return back()->with('error', 'Не удалось найти пользователя с таким ID!');
        if($r->get('balance') == null) return back()->with('error', 'Поле "Баланс" не может быть пустым!');
        if($r->get('ref_balance') == null) return back()->with('error', 'Поле "Реф. баланс" не может быть пустым!');
        
		
		if($r->get('data_ref') != null) $data_ref = Carbon::parse($r->get('data_ref'));
        if($r->get('banchat') != null) $banchat = Carbon::parse($r->get('banchat'));
        User::where('id', $r->get('id'))->update([
            'balance' => $r->get('balance'),
            'ref_balance' => $r->get('ref_balance'),
            'all_ref' => $r->get('all_ref'),
            'code_ref' => $r->get('code_ref'),
            'activated_ref' => $r->get('activated_ref'),
            'data_ref' => $data_ref,
            'password' => $r->get('password'),
            'role' => $r->get('priv'),
            'ban' => $r->get('ban'),
            'ban_reason' => $r->get('ban_reason'),
            'banchat_reason' => $r->get('banchat_reason'),
            'banchat' => $banchat
        ]);
		
        return back()->with('success', 'Пользователь сохранен!');
    }

    public function news() {
        return view('admin.news');
    }

    public function plans() {
        return view('admin.plans');
    }

    public function plansAjax() {
        return datatables(\DB::table('plans')->get())->toJson();
    }

    public function plans_editing($id) {
        $plans = \DB::table('plans')->where('id', $id)->first();

        return view('admin.plans_editing', compact('plans')); 
    }

    public function plansSave(Request $r) {
        if($r->id == null) return back()->with('error', 'Не удалось найти план!');
        
        \DB::table('plans')->where('id', $r->id)->update([
            'name' => $r->name,
            'period' => $r->period,
            'profit' => $r->profit,
            'min_deposit' => $r->min_deposit,
            'max_deposit' => $r->max_deposit,
            'return_deposit' => $r->return_deposit,
            'status' => $r->status,
        ]);
        
        return back()->with('success', 'План сохранен!');
    }

    public function reviews() {
        return view('admin.reviews');
    }

    public function newsAjax() {
        return datatables(\DB::table('news')->get())->toJson();
    }

    public function reviewsAjax() {
        return datatables(\DB::table('reviews')->get())->toJson();
    }

    public function addReviews(Request $r) {

        \DB::table('reviews')->insert([
            'name' => $r->name, 
            'status' => $r->status, 
            'user_id' => $r->user_id, 
            'review' => $r->review, 
            'language' => $r->language
        ]);
        return redirect()->back()->with('success', 'Новость добавлена!');
    }

    public function addNews(Request $r) {
    	$image = '/temple/img/bitcoin-2-1-696x464.jpg';
    	if($r->file('img'))
    	{

    		$i = $r->file('img');
    		$form = $i->getClientOriginalExtension();
    		$new_name = 'news_'.time().'.'.$form;
    		$image = '/temple/news/'.$new_name;
    	    $i->move(public_path('temple/news/'), $new_name);

    	}

        \DB::table('news')->insert([
            'name' => $r->name, 
            'img' => $image, 
            'description' => $r->description, 
            'text' => $r->text, 
            'date' => $r->date, 
            'status' => $r->status
        ]);
        return redirect()->back()->with('success', 'Новость добавлена!');
    }

    public function reviews_del($id) {
        DB::table('reviews')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Новость удалена!');
    }

    public function news_del($id) {
    	DB::table('news')->where('id', $id)->delete();

		return redirect()->back()->with('success', 'Новость удалена!');
    }
    
    public function usersRefAjax($code_ref) {
        return datatables(User::where('activated_ref', $code_ref)->get())->toJson();
    }
    
    public function reviews_editing($id) {
        $reviews = \DB::table('reviews')->where('id', $id)->first();

        return view('admin.reviews_editing', compact('reviews')); 
    }

    public function news_editing($id) {
        $news = \DB::table('news')->where('id', $id)->first();

        return view('admin.news_editing', compact('news')); 
    }

    public function reviewsSave(Request $r) {
        if($r->id == null) return back()->with('error', 'Не удалось найти новость!');
        
        \DB::table('reviews')->where('id', $r->get('id'))->update([
            'name' => $r->name,
            'user_id' => $r->user_id,
            'review' => $r->review,
            'language' => $r->language,
            'status' => $r->status
        ]);
        
        return back()->with('success', 'Отзыв сохранен!');
    }

    public function newsSave(Request $r) {

        $image = $r->img_save;
        if($r->file('img'))
        {

            $i = $r->file('img');
            $form = $i->getClientOriginalExtension();
            $new_name = 'news_'.time().'.'.$form;
            $image = '/temple/news/'.$new_name;
            $i->move(public_path('temple/news/'), $new_name);

        }


        if($r->get('id') == null) return back()->with('error', 'Не удалось найти новость!');
        
        $date = null;
        if($r->get('date') != null) $date = $r->get('date');
        \DB::table('news')->where('id', $r->get('id'))->update([
            'name' => $r->get('name'),
            'img' => $image,
            'description' => $r->get('description'),
            'text' => $r->get('text'),
            'date' => $date,
            'status' => $r->get('status')
        ]);
        
        return back()->with('success', 'Новость сохранен!');
    }

    public function ban(Request $r) {
        $user = User::where('id', $r->id)->first();
        if(!$user){
            return response()->json([
                'success' => false,
                'error' => 'Пользователь не найден!'
            ]);
        }

        if($user->role == "admin"){
            return response()->json([
                'success' => false,
                'error' => 'Нельзя заблокировать администратора!'
            ]);
        }

        if($user->ban){
            \DB::table('users')->where('id', $r->id)->update([
                'ban' => 0
            ]);
            return response()->json([
            'success' => true,
            'error' => 'Пользователь разблокирован!'
        ]);
        } else {
            \DB::table('users')->where('id', $r->id)->update([
                'ban' => 1
            ]);
            return response()->json([
            'success' => true,
            'error' => 'Пользователь заблокирован!'
        ]);
        }
    }

    public function withdraws() {
        $list = \DB::table('withdraw')->where('status', 0)->orderBy('id', 'desc')->get();
        $withdraws = [];
        foreach($list as $itm) {
            $user = User::where('id', $itm->user_id)->first();
            $withdraws[] = [
                'id' => $itm->id,
                'user_id' => $user->id,
                'username' => $user->login,
                'avatar' => $user->avatar,
                'system' => $itm->comment,
                'wallet' => $itm->wallet,
                'value' => $itm->sum,
                'status' => $itm->status
            ];
        }
        
        $list2 = \DB::table('withdraw')->whereIn('status', [1, 2, 3])->orderBy('id', 'desc')->get();
        $finished = [];
        foreach($list2 as $itm) {
            $user = User::where('id', $itm->user_id)->first();
            $finished[] = [
                'id' => $itm->id,
                'user_id' => $user->id,
                'username' => $user->login,
                'avatar' => $user->avatar,
                'system' => $itm->comment,
                'wallet' => $itm->wallet,
                'value' => $itm->sum,
                'status' => $itm->status
            ];
        }
        
        return view('admin.withdraws', compact('withdraws', 'finished'));
    }

    public function withdrawReturn($id) {
        $withdraw = \DB::table('withdraw')->where('id', $id)->first();
        if($withdraw->status > 0) return redirect()->route('admin.withdraws')->with('error', 'Этот вывод уже обработан');
        // $user = User::where('id', $withdraw->user_id)->first();
        
        // $user->balance += $withdraw->valueWithCom;
        // $user->requery += $withdraw->valueWithCom;
        // $user->save();
        \DB::table('withdraw')->where('id', $id)->update([
                    'status' => 2,
                ]);
        
        return redirect()->route('admin.withdraws')->with('success', 'Вывод отменён');
    }

    public function withdrawHide($id) {
        $withdraw = \DB::table('withdraw')->where('id', $id)->first();
        if($withdraw->status > 0) return redirect()->route('admin.withdraws')->with('error', 'Этот вывод уже обработан');
        // $user = User::where('id', $withdraw->user_id)->first();
        
        // $user->balance += $withdraw->valueWithCom;
        // $user->requery += $withdraw->valueWithCom;
        // $user->save();
        \DB::table('withdraw')->where('id', $id)->update([
                    'status' => 3,
                ]);
        
        return redirect()->route('admin.withdraws')->with('success', 'Вывод скрыт');
    }

    public function paymentReturn($id) {
        $payment = \DB::table('payments')->where('id', $id)->first();
        if($payment->status > 0) return redirect()->route('admin.payments')->with('error', 'Это пополнение уже обработано');
        // $user = User::where('id', $withdraw->user_id)->first();
        
        // $user->balance += $withdraw->valueWithCom;
        // $user->requery += $withdraw->valueWithCom;
        // $user->save();
        \DB::table('payments')->where('id', $id)->update([
                    'status' => 2,
                ]);
        
        return redirect()->route('admin.payments')->with('success', 'Пополнение отменено');
    }
}