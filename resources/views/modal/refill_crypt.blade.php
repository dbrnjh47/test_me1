<div class="modal refill_modal" id="refill_crypt">
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
                    <h1>Пополнение баланса</h1>
                </div>
                <div class="refill_crypt_wrapper_wallet_img">
                    <img src="/temple/imgs/wallet_cripta.png" alt="">
                    <div>
                        <p>Необходимая сумма платежа зависит от текущего курса и приблизительно равна <span>0.00000000 BTC</span>.</p>
                        <p>Это <span>ваш персональный адрес</span> для депозитов. Любые платежи, переведенныена данный адрес, поступят на ваш баланс.</p>
                    </div>
                </div>
                <div class="input_refill_crypt_wrapper_wallet">
                    <input type="text" value="19BN8JJLpcPGBeAYdeXYXx7m1wn1VHYF7e" readonly>
                    <div>
                        <div class="input_refill_crypt_wrapper_wallet_svg">
                            <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.71875 16H3.75C2.37146 16 1.25 14.8785 1.25 13.5V5.03125C1.25 3.65271 2.37146 2.53125 3.75 2.53125H9.71875C11.0973 2.53125 12.2188 3.65271 12.2188 5.03125V13.5C12.2188 14.8785 11.0973 16 9.71875 16ZM3.75 3.78125C3.06079 3.78125 2.5 4.34204 2.5 5.03125V13.5C2.5 14.1892 3.06079 14.75 3.75 14.75H9.71875C10.408 14.75 10.9688 14.1892 10.9688 13.5V5.03125C10.9688 4.34204 10.408 3.78125 9.71875 3.78125H3.75ZM14.7188 11.9375V2.5C14.7188 1.12146 13.5973 0 12.2188 0H5.28125C4.93604 0 4.65625 0.279785 4.65625 0.625C4.65625 0.970215 4.93604 1.25 5.28125 1.25H12.2188C12.908 1.25 13.4688 1.81079 13.4688 2.5V11.9375C13.4688 12.2827 13.7485 12.5625 14.0938 12.5625C14.439 12.5625 14.7188 12.2827 14.7188 11.9375Z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>