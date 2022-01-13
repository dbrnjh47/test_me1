<div class="modal refill_modal refill_card" id="refill_card">
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
            <div class="refill_crypt_wrapper_wallet refill_crypt_wrapper_wallet_proceed">
                <p>Укажите сумму депозита</p>
                <button class="refill_crypt_wrapper_choice_button">Продолжить</button>
            </div>
        </div>
    </div>
    <div class="inout_block inout_block_card_save">
        <div class="modal_h1">
            <h1>Банковские карты</h1>
        </div>
        <font>Сохраненные карты</font>
        <div class="inout_block_card_save_wrapper">
            <div class="inout_block_card_save_item">
                <p>Новая карта</p>
            </div>
            <div class="inout_block_card_save_item inout_block_card_save_item_user_card">
                <div class="inout_block_card_save_item_user_card_name">
                    <p>**** **** **** 2956</p>
                    <svg width="9" height="9" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 0.9L8.1 0L4.5 3.6L0.9 0L0 0.9L3.6 4.5L0 8.1L0.9 9L4.5 5.4L8.1 9L9 8.1L5.4 4.5L9 0.9Z" />
                    </svg>
                </div>
                <div class="inout_block_card_save_item_user_card_data">
                    <p>02/2023</p>
                    <img src="/temple/imgs/refill/visa.png" alt="">
                </div>
            </div>
        </div>
        <div class="input_block_card_save_wrapper">
            <div>
                <p>Номер карты</p>
                <input type="text">
                <p>Срок действия карты</p>
                <div class="input_block_card_save_wrapper_date">
                    <div class="language menu_select" id="day_replenishment">
                        <div>
                            <div>
                                <input type="hidden" name="day" value="">
                                <span>День</span>
                                <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.366116 0.536342C0.854272 0.0751514 1.64573 0.0751514 2.13388 0.536342L5 3.24414L7.86612 0.536342C8.35427 0.0751511 9.14573 0.0751511 9.63388 0.536342C10.122 0.997532 10.122 1.74527 9.63388 2.20646L5.88388 5.74932C5.39573 6.21051 4.60427 6.21051 4.11612 5.74932L0.366116 2.20646C-0.122039 1.74527 -0.122039 0.997533 0.366116 0.536342Z" fill="#686D87"></path>
                                </svg>
                            </div>
                        </div>
                        <ul>
                        	@for ($i = 1; $i <= 31; $i++)
                        	<li data-value="{{$i}}"><span>{{$i}}</span></li>
							@endfor
                        </ul>
                    </div>
                    <div class="language menu_select" id="month_replenishment">
                        <div>
                            <div>
                                <input type="hidden" name="month" value="">
                                <span>Месяц</span>
                                <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.366116 0.536342C0.854272 0.0751514 1.64573 0.0751514 2.13388 0.536342L5 3.24414L7.86612 0.536342C8.35427 0.0751511 9.14573 0.0751511 9.63388 0.536342C10.122 0.997532 10.122 1.74527 9.63388 2.20646L5.88388 5.74932C5.39573 6.21051 4.60427 6.21051 4.11612 5.74932L0.366116 2.20646C-0.122039 1.74527 -0.122039 0.997533 0.366116 0.536342Z" fill="#686D87"></path>
                                </svg>
                            </div>
                        </div>
                        <ul>
                        	<?php $months = array( 1 => 'Январь' , 'Февраль' , 'Март' , 'Апрель' , 'Май' , 'Июнь' , 'Июль' , 'Август' , 'Сентябрь' , 'Октябрь' , 'Ноябрь' , 'Декабрь' ); ?>
                            @foreach ($months as $m)
                            <li data-value="{{$m}}"><span>{{$m}}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <p>CVV</p>
                <input type="text">
                <p>Имя и Фамилия</p>
                <input type="text">
            </div>
            <div>
                <p>Номер телефона</p>
                <input type="text">
                <p>Валюта</p>
                <div class="language menu_select" id="currency_replenishment">
                    <div>
                        <div>
                            <input type="hidden" name="currency" value="{{$currency[0]->name}}">
                            <span>{{$currency[0]->name}}</span>
                            <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.366116 0.536342C0.854272 0.0751514 1.64573 0.0751514 2.13388 0.536342L5 3.24414L7.86612 0.536342C8.35427 0.0751511 9.14573 0.0751511 9.63388 0.536342C10.122 0.997532 10.122 1.74527 9.63388 2.20646L5.88388 5.74932C5.39573 6.21051 4.60427 6.21051 4.11612 5.74932L0.366116 2.20646C-0.122039 1.74527 -0.122039 0.997533 0.366116 0.536342Z" fill="#686D87"></path>
                            </svg>
                        </div>
                    </div>
                    <ul>
                        @foreach ($currency as $c)
                        <li data-value="{{$c->name}}"><span>{{$c->name}}</span></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <button class="refill_crypt_wrapper_choice_button">Пополнить счёт</button>
    </div>
</div>