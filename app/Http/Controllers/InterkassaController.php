<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;
use DB;

class InterkassaController extends Controller
{
    const SCI_ENDPOINT = "https://sci.interkassa.com";

    const MARCHANT_ID = "6110f996afb3000d0a182baa";
    const SECRET_KEY = "Hy3MGN02JqNrYWnp";
    const TEST_KEY = "VjKrMPi9yKcqZ1Rn";

    public static function create($id, $amount) {
        $payload = [
            'ik_co_id' => self::MARCHANT_ID,
            'ik_pw_via' => 'test_interkassa_test_xts',
            'ik_act' => "payways", // process; payways
            'ik_pm_no' => $id,
            'ik_am' => $amount,
            'ik_cur' => 'RUB',
            'ik_desc' => 'test',
        ];

        $payload['ik_sign'] = self::generateSign($payload, self::SECRET_KEY);
        return [
            "link" => self::SCI_ENDPOINT."/?".http_build_query($payload)
        ];
    }

    public function paymentHandler(Request $r) {
        Log::debug("PAYMENT");
        Log::debug(json_encode($r->all()));

        $payment = \DB::table('payments')->where([
            'id' => $r->get('ik_pm_no'),
            'status' => 0,
        ])->first();
        if(!$payment) return;

        if(
            $payment->amount != $r->get('ik_am')
            || $r->get('ik_inv_st') !== 'success'
            || $r->get('ik_sign') !== self::generateSign($r->all(), self::TEST_KEY)
        ) {
            return;
        }
        PaymentController::acceptPayment($payment->id);
        return response("OK");
    }

    public static function generateSign($dataSet, $key) {
        unset($dataSet['ik_sign']);
        ksort($dataSet, SORT_STRING);
        array_push($dataSet, $key);
        $signString = implode(':', $dataSet);
        $sign = base64_encode(hash('sha256', $signString, true));
        return $sign;
    }
}