<div class="modal refill_modal withdrawal_crypt" id="withdrawal_crypt">
    @include('modal.menu', array('modal'=>'withdrawal'))
    <div class="inout_block refill_crypt">
        <div class="refill_crypt_wrapper">
            <div class="refill_crypt_wrapper_choice">
                <div class="modal_h1">
                    <h1>Платежная система</h1>
                </div>
                <img src="/temple/imgs/refill/refill_1.png" alt="">
                <button class="m_open refill_crypt_wrapper_choice_button" href="#withdrawal">Изменить</button>
            </div>
            <div class="refill_crypt_wrapper_input">
                <div class="modal_h1">
                    <h1>Сумма выплаты</h1>
                </div>
                <div class="refill_crypt_input_currencies">
                    <input type="text" placeholder="Минимум 500₽">
                    <div>₽</div>
                </div>
                <div class="refill_crypt_button_sum">
                    <div>500₽</div>
                    <div>1 000₽</div>
                    <div>2 500₽</div>
                    <div>5 000₽</div>
                    <div>10 000₽</div>
                </div>
            </div>
            <div class="refill_crypt_wrapper_wallet">
                <div class="modal_h1">
                    <h1>Выплата</h1>
                </div>
                
                <div class="input_refill_crypt_wrapper_wallet input_refill_crypt_wrapper_wallet_block">
                    <input type="text" placeholder="19BN8JJLpcPGBeAYdeXYXx7m1wn1VHYF7e">
                </div>

                <div class="refill_crypt_wrapper_choice_button_save">Отправить</div>
            </div>
        </div>
    </div>
</div>