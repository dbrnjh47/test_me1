<div class="modal refill_modal refill_card" id="refill_pay">
    @include('modal.menu', array('modal'=>'refill'))
    <div class="inout_block refill_crypt">
        <div class="refill_crypt_wrapper">
            <div class="refill_crypt_wrapper_choice">
                <div class="modal_h1">
                    <h1>Платежная система</h1>
                </div>
                <img src="/temple/imgs/refill/refill_1.png" alt="">
                <button class="m_open refill_crypt_wrapper_choice_button" href="#refill">Изменить</button>
            </div>
            <div class="refill_crypt_wrapper_input">
                <div class="modal_h1">
                    <h1>Сумма платежа</h1>
                </div>
                <div class="refill_crypt_input_currencies">
                    <input type="text" placeholder="Минимум 500₽" name="sum">
                    <div>{{$currency_user->briefly}}</div>
                </div>
                <div class="refill_crypt_button_sum">
                    <div data-sum="{{$currency_user->refill_sum_1}}">{{$currency_user->refill_sum_1}}{{$currency_user->briefly}}</div>
                    <div data-sum="{{$currency_user->refill_sum_2}}">{{$currency_user->refill_sum_2}}{{$currency_user->briefly}}</div>
                    <div data-sum="{{$currency_user->refill_sum_3}}">{{$currency_user->refill_sum_3}}{{$currency_user->briefly}}</div>
                    <div data-sum="{{$currency_user->refill_sum_4}}">{{$currency_user->refill_sum_4}}{{$currency_user->briefly}}</div>
                    <div data-sum="{{$currency_user->refill_sum_5}}">{{$currency_user->refill_sum_5}}{{$currency_user->briefly}}</div>
                </div>
            </div>
            <div class="refill_crypt_wrapper_wallet refill_crypt_wrapper_wallet_proceed">
                <p>Укажите сумму депозита</p>
                <button class="refill_crypt_wrapper_choice_button">Продолжить</button>
            </div>
        </div>
    </div>
</div>