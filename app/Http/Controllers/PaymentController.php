<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\InterkassaController;
use DB;

class PaymentController extends Controller
{

    public function test(Request $r) {
        if(!$r->sum || $r->sum <= 0 || $r->sum > 50000 || !is_numeric($r->sum) || !preg_match('/^\d+$/', $r->sum)){
            return response()->json([
                "success" => false,
                "error" => "Минимальная сумма от 1 до 50000!"
            ]);
        }

        $paymentSystem = $r->get('system');
        // $amount = floor($r->get('amount')) || 100;
        $amount = floor($r->sum);

        $payment = DB::table('payments')->insertGetId([
            "uId" => $this->user->id,
            "amount" => $amount
        ]);

        $response = InterkassaController::create($payment, $amount);

        return response()->json([
            "success" => true,
            "link" => $response['link'],
        ]);

        return redirect($response['link']);
        return response()->json([
            "system" => "interkassa",
            "link" => $response['link']
        ]);

    }

    public static function acceptPayment($id) {
        $payment = \DB::table('payments')->where([
            'id' => $id,
            'status' => 0,
        ])->first();
        if(!$payment) return

        \DB::table('payments')->where('id', $payment->id)->update([
            'status' => 1
        ]);
        DB::update('UPDATE users SET balance = balance + '.$payment->amount.' WHERE id = '.$payment->uId);
    }

}