@if($dynamics == null)
@include('header')
@endif

<?php $currency_user = App\Settings::currency($u->currency); ?>
<div class="modal" id="update_avatar">
    <div class="inout_block">
        <div class="modal_h1">
            <h1>Загрузить аватар</h1>
            <svg class="close" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 1.3L11.7 0L6.5 5.2L1.3 0L0 1.3L5.2 6.5L0 11.7L1.3 13L6.5 7.8L11.7 13L13 11.7L7.8 6.5L13 1.3Z" fill="white"></path>
            </svg>
        </div>
        <form method="POST" style="display: grid;" id="form_update_avatar">
            <input type="file" class="form_update_file" name="img" accept="image/*" style="display: none;">
            <div class="block_wrapper_prof_menu_button_div" onclick="loading_avatar();">Выбрать файл</div>
            <span>Загрузите png, jpeg или jpg</span>
            <div class="button_modal" onclick="update_avatar();">Обновить</div>
        </form>
    </div>
</div>
<div class="modal" id="change_password">
    <div class="inout_block">
        <div class="modal_h1">
            <h1>Смена пароля</h1>
            <svg class="close" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 1.3L11.7 0L6.5 5.2L1.3 0L0 1.3L5.2 6.5L0 11.7L1.3 13L6.5 7.8L11.7 13L13 11.7L7.8 6.5L13 1.3Z" fill="white"></path>
            </svg>
        </div>
        <div class="change_password_wrapper_old_password">
            <p>Старый пароль</p>
            <input name="old_password" type="text" placeholder="Введите Ваш старый пароль">
        </div>
        <div class="change_password_wrapper">
            <div>
                <p>Новый пароль</p>
                <input name="new_password" type="text" placeholder="Введите новый пароль" style="width: calc(100% - 35px);">
            </div>
            <div>
                <p>Повторите пароль</p>
                <input name="new_password_repeat" type="text" placeholder="Повторите новый пароль">
            </div>
        </div>
        <div class="button_modal button_modal_green" onclick="update_avatar();">Сбросить</div>
    </div>
</div>
<script>
    /* Локализация datepicker */
    // https://api.jqueryui.com/datepicker/#option-yearRange
$.datepicker.regional['ru'] = {
    closeText: 'Закрыть',
    prevText: 'Предыдущий',
    nextText: 'Следующий',
    currentText: 'Сегодня',
    monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль2','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
    dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
    dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
    weekHeader: 'Не',
    dateFormat: 'dd.mm.yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['ru']);
$(function(){
    @if($u->date_of_birth) 
    $(".datepicker-here").datepicker({
      changeMonth: true,
      showOtherMonths: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "1950:{{date("Y")}}",
    }).datepicker('setDate', new Date('{{$u->date_of_birth}}'));; 
    @else 
    $(".datepicker-here").datepicker({
        changeMonth: true,
        showOtherMonths: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "1950:{{date("Y")}}",
    });
    @endif
});
</script>
<title>{{$settings->project_name}} | Профиль</title>
<link rel="stylesheet" href="/temple/css/profile.css?{{time()}}">
@include('header_game')
<div class="block_wrapper">
    <div class="block_wrapper_prof block_wrapper_prof_flex">
        <div class="user_prof">
            <div class="user_info_tall">
                <div class="m_open avatar_update" href="#update_avatar" style="background:  url({{$u->avatar}}) no-repeat 0 0 / 100% 100% "></div>
                <div style="width: 100%;">
                    <p>{{$u->login}}</p>
                    <a>Бонусы: <span>{{$u->bonus}} {{$currency_user->briefly}}</span></a>
                </div>
            </div>
        </div>
        <div class="block_wrapper_prof_menu_button">
            <div class="block_wrapper_prof_menu_button_div m_open" href="#update_avatar">Загрузить аватар</div>
            <div class="block_wrapper_prof_menu_button_div m_open" href="#change_password">Сменить пароль</div>
        </div>
    </div>
</div>
<div class="block_wrapper" style="margin-top: 25px;">
    <div class="block_wrapper_prof">
        <div class="flex" id="info_user_secondary">
            <div class="user_info">
                <div class="user_info_item">
                    <p>E-mail адрес</p>
                    <input name="email" type="text" placeholder="Введите Ваш e-mail адрес" @if($u->email) value="{{(substr($u->email, 0, strlen($u->email)/2)).'*****'}}" @endif>
                </div>
                <div class="user_info_item">
                    <p>Номер телефона</p>
                    <input name="telephone" type="text" placeholder="Введите Ваш телефон" @if($u->telephone) value="{{(substr($u->telephone, 0, strlen($u->telephone)/2)).'*****'}}" @endif>
                </div>
                <div>
                    <p>Адрес</p>
                    <input name="address" type="text" placeholder="Введите Ваш адрес" @if($u->address) value="{{(substr($u->address, 0, strlen($u->address)/2)).'*****'}}" @endif>
                </div>
            </div>
            <div class="user_info">
                <div>
                    <p>Фамилия</p>
                    <input name="surname" type="text" placeholder="Введите Вашу фамилию" @if($u->surname) value="{{(substr($u->surname, 0, strlen($u->surname)/2)).'*****'}}" @endif>
                </div>
                <div>
                    <p>Имя</p>
                    <input name="name" type="text" placeholder="Введите Ваше имя" @if($u->name) value="{{(substr($u->name, 0, strlen($u->name)/2)).'*****'}}" @endif>
                </div>
                <div>
                    <p>Отчество</p>
                    <input name="patronymic" type="text" placeholder="Введите Ваше отчество" @if($u->patronymic) value="{{(substr($u->patronymic, 0, strlen($u->patronymic)/2)).'*****'}}" @endif>
                </div>
            </div>
            <div class="user_info">
                <div class="user_info_item user_info_item_block">
                    <div class="user_info_item_wrapper">
                        <p>Никнейм</p>
                        <input name="login" type="text" placeholder="Введите Ваш никнейм" value="{{$u->login}}">
                    </div>
                    <div class="user_info_item_wrapper user_info_item_wrapper_language">
                        <p>Пол</p>
                        <div class="input_block_card_save_wrapper_date">
                            <div class="language menu_select" id="gender_input" data-sm="1">
                                <div>
                                    <div>
                                        <input type="hidden" name="gender" value="{{$u->gender}}">
                                        <span>@if($u->gender) @if($u->gender == "Ж") Женский @else Мужской @endif @else Выберите ваш пол @endif</span>
                                        <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.366116 0.536342C0.854272 0.0751514 1.64573 0.0751514 2.13388 0.536342L5 3.24414L7.86612 0.536342C8.35427 0.0751511 9.14573 0.0751511 9.63388 0.536342C10.122 0.997532 10.122 1.74527 9.63388 2.20646L5.88388 5.74932C5.39573 6.21051 4.60427 6.21051 4.11612 5.74932L0.366116 2.20646C-0.122039 1.74527 -0.122039 0.997533 0.366116 0.536342Z" fill="#686D87"></path>
                                        </svg>
                                    </div>
                                </div>
                                <ul>
                                    <li data-value="Ж"><span>Женский</span></li>
                                    <li data-value="М"><span>Мужской</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_info_item user_info_item_block">
                    <div class="user_info_item_wrapper">
                        <p>Индекс</p>
                        <input name="index_address" type="text" placeholder="Введите Ваш индекс" @if($u->index_address) value="{{(substr($u->index_address, 0, strlen($u->index_address)/2)).'*****'}}" @endif>
                    </div>
                    <div class="user_info_item_wrapper">
                        <p>Город и страна</p>
                        <input name="city" type="text" placeholder="Введите Ваш город и Вашу страну" value="{{$u->city}}">
                    </div>
                </div>
                <div class="flex">
                    <div class="datepicker-here_wrapper user_info_item" style="    margin-right: 2% !important;width: 59%;">
                        <p>Дата рождения</p>
                        <input type="text" name="date_of_birth" placeholder="Укажите дату рождения" class="datepicker-here">
                    </div>
                    <div class="data_svg">
                        <svg width="20" height="19" viewBox="0 0 20 19" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.28685 10.4821C7.28685 10.2441 7.08363 10.0513 6.83289 10.0513H5.24875C4.9983 10.0513 4.79504 10.2441 4.79504 10.4821V11.9868C4.79504 12.2252 4.9983 12.4181 5.24875 12.4181H6.83289C7.08363 12.4181 7.28685 12.2252 7.28685 11.9868V10.4821Z" />
                            <path d="M7.28685 10.4821C7.28685 10.2441 7.08363 10.0513 6.83289 10.0513H5.24875C4.9983 10.0513 4.79504 10.2441 4.79504 10.4821V11.9868C4.79504 12.2252 4.9983 12.4181 5.24875 12.4181H6.83289C7.08363 12.4181 7.28685 12.2252 7.28685 11.9868V10.4821Z" />
                            <path d="M11.2458 10.4821C11.2458 10.2441 11.0426 10.0513 10.7923 10.0513H9.20798C8.95753 10.0513 8.75427 10.2441 8.75427 10.4821V11.9868C8.75427 12.2252 8.95753 12.4181 9.20798 12.4181H10.7923C11.0426 12.4181 11.2458 12.2252 11.2458 11.9868V10.4821Z" />
                            <path d="M11.2458 10.4821C11.2458 10.2441 11.0426 10.0513 10.7923 10.0513H9.20798C8.95753 10.0513 8.75427 10.2441 8.75427 10.4821V11.9868C8.75427 12.2252 8.95753 12.4181 9.20798 12.4181H10.7923C11.0426 12.4181 11.2458 12.2252 11.2458 11.9868V10.4821Z" />
                            <path d="M15.2051 10.4821C15.2051 10.2441 15.0018 10.0513 14.7513 10.0513H13.1672C12.9165 10.0513 12.7133 10.2441 12.7133 10.4821V11.9868C12.7133 12.2252 12.9165 12.4181 13.1672 12.4181H14.7513C15.0018 12.4181 15.2051 12.2252 15.2051 11.9868V10.4821Z" />
                            <path d="M15.2051 10.4821C15.2051 10.2441 15.0018 10.0513 14.7513 10.0513H13.1672C12.9165 10.0513 12.7133 10.2441 12.7133 10.4821V11.9868C12.7133 12.2252 12.9165 12.4181 13.1672 12.4181H14.7513C15.0018 12.4181 15.2051 12.2252 15.2051 11.9868V10.4821Z" />
                            <path d="M7.28685 14.2436C7.28685 14.0052 7.08363 13.8125 6.83289 13.8125H5.24875C4.9983 13.8125 4.79504 14.0052 4.79504 14.2436V15.748C4.79504 15.9862 4.9983 16.1791 5.24875 16.1791H6.83289C7.08363 16.1791 7.28685 15.9862 7.28685 15.748V14.2436Z" />
                            <path d="M7.28685 14.2436C7.28685 14.0052 7.08363 13.8125 6.83289 13.8125H5.24875C4.9983 13.8125 4.79504 14.0052 4.79504 14.2436V15.748C4.79504 15.9862 4.9983 16.1791 5.24875 16.1791H6.83289C7.08363 16.1791 7.28685 15.9862 7.28685 15.748V14.2436Z" />
                            <path d="M11.2458 14.2436C11.2458 14.0052 11.0426 13.8125 10.7923 13.8125H9.20798C8.95753 13.8125 8.75427 14.0052 8.75427 14.2436V15.748C8.75427 15.9862 8.95753 16.1791 9.20798 16.1791H10.7923C11.0426 16.1791 11.2458 15.9862 11.2458 15.748V14.2436Z" />
                            <path d="M11.2458 14.2436C11.2458 14.0052 11.0426 13.8125 10.7923 13.8125H9.20798C8.95753 13.8125 8.75427 14.0052 8.75427 14.2436V15.748C8.75427 15.9862 8.95753 16.1791 9.20798 16.1791H10.7923C11.0426 16.1791 11.2458 15.9862 11.2458 15.748V14.2436Z" />
                            <path d="M15.2051 14.2436C15.2051 14.0052 15.0018 13.8125 14.7516 13.8125H13.1672C12.9165 13.8125 12.7133 14.0052 12.7133 14.2436V15.748C12.7133 15.9862 12.9165 16.1791 13.1672 16.1791H14.7516C15.0018 16.1791 15.2051 15.9862 15.2051 15.748V14.2436Z" />
                            <path d="M15.2051 14.2436C15.2051 14.0052 15.0018 13.8125 14.7516 13.8125H13.1672C12.9165 13.8125 12.7133 14.0052 12.7133 14.2436V15.748C12.7133 15.9862 12.9165 16.1791 13.1672 16.1791H14.7516C15.0018 16.1791 15.2051 15.9862 15.2051 15.748V14.2436Z" />
                            <path d="M18.0376 2.11567V4.41404C18.0376 5.45287 17.1505 6.29001 16.0572 6.29001H14.8079C13.7144 6.29001 12.8156 5.45287 12.8156 4.41404V2.10742H7.18453V4.41404C7.18453 5.45287 6.28571 6.29001 5.19245 6.29001H3.94288C2.84957 6.29001 1.96251 5.45287 1.96251 4.41404V2.11567C1.00695 2.14304 0.221741 2.8942 0.221741 3.81747V17.287C0.221741 18.2276 1.02428 19.0001 2.01442 19.0001H17.9857C18.9743 19.0001 19.7784 18.226 19.7784 17.287V3.81747C19.7784 2.8942 18.9932 2.14304 18.0376 2.11567ZM17.4574 16.4482C17.4574 16.8547 17.1104 17.1845 16.6824 17.1845H3.28361C2.85555 17.1845 2.50861 16.8547 2.50861 16.4482V9.49071C2.50861 9.08405 2.85551 8.75426 3.28361 8.75426H16.6823C17.1104 8.75426 17.4573 9.08405 17.4573 9.49071L17.4574 16.4482Z" />
                            <path d="M18.0376 2.11567V4.41404C18.0376 5.45287 17.1505 6.29001 16.0572 6.29001H14.8079C13.7144 6.29001 12.8156 5.45287 12.8156 4.41404V2.10742H7.18453V4.41404C7.18453 5.45287 6.28571 6.29001 5.19245 6.29001H3.94288C2.84957 6.29001 1.96251 5.45287 1.96251 4.41404V2.11567C1.00695 2.14304 0.221741 2.8942 0.221741 3.81747V17.287C0.221741 18.2276 1.02428 19.0001 2.01442 19.0001H17.9857C18.9743 19.0001 19.7784 18.226 19.7784 17.287V3.81747C19.7784 2.8942 18.9932 2.14304 18.0376 2.11567ZM17.4574 16.4482C17.4574 16.8547 17.1104 17.1845 16.6824 17.1845H3.28361C2.85555 17.1845 2.50861 16.8547 2.50861 16.4482V9.49071C2.50861 9.08405 2.85551 8.75426 3.28361 8.75426H16.6823C17.1104 8.75426 17.4573 9.08405 17.4573 9.49071L17.4574 16.4482Z" />
                            <path d="M3.93837 5.05776H5.17413C5.54922 5.05776 5.85335 4.76927 5.85335 4.41293V0.645059C5.85335 0.288687 5.54922 0 5.17413 0H3.93837C3.56324 0 3.25916 0.288687 3.25916 0.645059V4.41293C3.25916 4.76927 3.56324 5.05776 3.93837 5.05776Z" />
                            <path d="M3.93837 5.05776H5.17413C5.54922 5.05776 5.85335 4.76927 5.85335 4.41293V0.645059C5.85335 0.288687 5.54922 0 5.17413 0H3.93837C3.56324 0 3.25916 0.288687 3.25916 0.645059V4.41293C3.25916 4.76927 3.56324 5.05776 3.93837 5.05776Z" />
                            <path d="M14.7919 5.05776H16.0277C16.4025 5.05776 16.7066 4.76927 16.7066 4.41293V0.645059C16.7067 0.288687 16.4025 0 16.0277 0H14.7919C14.4169 0 14.1127 0.288687 14.1127 0.645059V4.41293C14.1127 4.76927 14.4169 5.05776 14.7919 5.05776Z" />
                            <path d="M14.7919 5.05776H16.0277C16.4025 5.05776 16.7066 4.76927 16.7066 4.41293V0.645059C16.7067 0.288687 16.4025 0 16.0277 0H14.7919C14.4169 0 14.1127 0.288687 14.1127 0.645059V4.41293C14.1127 4.76927 14.4169 5.05776 14.7919 5.05776Z" />
                        </svg>
                    </div>
                    <div class="block_wrapper_prof_menu_button_div block_wrapper_prof_menu_button_div_grin" style="    margin-right: 0; margin-top: 32px; padding: 9px; width: 45%;">Сохранить</div>
                </div>
                <!-- <div class="pol_user_info">
                    Ваш пол: 
                    <div class="checkbox_inout_block">
                        <div class="wrapper_checkbox_inout">
                            <input type="checkbox" data-gender="M" name="gender" @if($u->gender == "M") checked="gender" @endif class="checkbox_input" id="Male_checkbox" required="">
                            <label for="Male_checkbox"></label>
                        </div>
                        <label for="Male_checkbox" @if($u->gender == "M") class="activ" @endif>Мужской</label>
                    </div>
                    <div class="checkbox_inout_block">
                        <div class="wrapper_checkbox_inout">
                            <input type="checkbox" data-gender="W" name="gender" @if($u->gender == "W") checked="gender" @endif class="checkbox_input" id="Female_checkbox">
                            <label for="Female_checkbox"></label>
                        </div>
                        <label for="Female_checkbox" @if($u->gender == "W") class="activ" @endif>Женский</label>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<div class="block_wrapper profil_verification_alerts">
    <div class="flex">
        <div class="block_wrapper_prof">
            <div class="block_verification_alerts" style="display: grid;" id="setting_alerts">
                <h1>Получение оповещений</h1>
                <font>Не пропустите бонусы и подарки от {{$settings->project_name}}:</font>
                <div class="checkbox_inout_block">
                    <div class="wrapper_checkbox_inout">
                        <input type="checkbox" name="email_distribution" class="checkbox_input" required="" id="email_distribution" @if($u->email_alerts) checked="checked" @endif>
                        <label for="email_distribution"></label>
                    </div>
                    <label for="email_distribution">Я согласен на получение email-рассылок</label>
                </div>
                <div class="checkbox_inout_block">
                    <div class="wrapper_checkbox_inout">
                        <input type="checkbox" name="sms_distribution" class="checkbox_input" required="" id="sms_distribution" @if($u->sms_alerts) checked="checked" @endif>
                        <label for="sms_distribution"></label>
                    </div>
                    <label for="sms_distribution">Я согласен на получение смс</label>
                </div>
                <div class="checkbox_inout_block">
                    <div class="wrapper_checkbox_inout">
                        <input type="checkbox" name="bonus_distribution" class="checkbox_input" required="" id="bonus_distribution" @if($u->bonus_alerts) checked="checked" @endif>
                        <label for="bonus_distribution"></label>
                    </div>
                    <label for="bonus_distribution">Я согласен на получение бонусов и подарков</label>
                </div>
                <div class="block_wrapper_prof_menu_button_div block_wrapper_prof_menu_button_div_grin">Сохранить</div>
            </div>
        </div>
        <div class="block_wrapper_prof" style="    margin-right: 0;">
            <div class="block_verification_alerts block_Verification">
                <h1>Верификация</h1>
                <p>
                    Для прохождения верификации необходимо прислать сканированное цветное изображение или цифровую фотографию документа, удостоверяющего вашу личность. Должны быть четко видны следующие данные: ФИО, дата рождения, город, подпись, фото, номер документа. В случае депозита с банковской карты нужно прислать ее фото только с лицевой стороны. На лицевой стороне карты должны быть видны первые шесть цифр и последние четыре, а также имя владельца карты и срок ее действия. Остальные цифры на вашей карте необходимо скрыть. На обратной стороне должна быть видна ваша подпись. CVV-код должен быть скрыт. Часть цифр на обратной стороне также должна быть скрыта. В некоторых случаях служба безопасности может запросить дополнительные документы.
                </p>
                <div class="file_block_Verification_wrapper">
                    <form method="POST" style="display: none;" id="form_Verification">
                        <input type="file" name="img[]" accept="image/*" multiple style="display: none" id="input_Verification">
                    </form>
                    <div class="file_block_Verification">
                        <a id="button_Verification">Выберите файл(ы)</a>
                        <p>(Максимальный размер: 10 МВ)</p>
                    </div>
                    <div class="block_wrapper_prof_menu_button_div block_wrapper_prof_menu_button_div_grin" id="submit_Verification">Подтвердить</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$("#button_Verification").on('click', function() {
    $("#input_Verification").click();
});

$("#submit_Verification").on('click', function() {
    console.log('1');
    var formData = new FormData();
    $.each($("#input_Verification")[0].files, function(key, input) {
        formData.append('img', input);
    });

    $.ajax({
        type: "POST",
        url: '/submit_Verification',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        dataType: 'json',
        success: function(data) {
            if (data.success == true) {
                error_modal(data.error, 1);
            } else {
                error_modal(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
});

$("#setting_alerts .block_wrapper_prof_menu_button_div").on('click', function() {
    $.ajax({
        url: '/setting_alerts',
        type: "POST",
        data: {
            'email_distribution': +$('#email_distribution').is(":checked"),
            'sms_distribution': +$('#sms_distribution').is(":checked"),
            'bonus_distribution': +$('#bonus_distribution').is(":checked"),
        },
        success: function(data) {
            console.log(data.error);
            if (data.success == true) {
                $('*[data-href="/profile_dynamics"]').click();
                error_modal(data.error, 1);
            } else {
                error_modal(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
});

$("#info_user_secondary .block_wrapper_prof_menu_button_div_grin").on('click', function() {
    $.ajax({
        url: '/info_user_secondary_save',
        type: "POST",
        data: {
            'email': $('#info_user_secondary input[name="email"]').val(),
            'telephone': $('#info_user_secondary input[name="telephone"]').val(),
            'address': $('#info_user_secondary input[name="address"]').val(),
            'surname': $('#info_user_secondary input[name="surname"]').val(),
            'name': $('#info_user_secondary input[name="name"]').val(),
            'patronymic': $('#info_user_secondary input[name="patronymic"]').val(),
            'login': $('#info_user_secondary input[name="login"]').val(),
            'index_address': $('#info_user_secondary input[name="index_address"]').val(),
            'date_of_birth': $('#info_user_secondary input[name="date_of_birth"]').val(),
            'city': $('#info_user_secondary input[name="city"]').val(),
            'gender': $('#info_user_secondary input[name="gender"]').val(),
        },
        success: function(data) {
            console.log(data.error);
            if (data.success == true) {
                $('*[data-href="/profile_dynamics"]').click();
                error_modal(data.error, 1);
            } else {
                error_modal(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
});

$("#change_password .button_modal_green").on('click', function() {
    $.ajax({
        url: '/change_password',
        type: "POST",
        data: {
            'old_password': $('#change_password input[name="old_password"]').val(),
            'new_password': $('#change_password input[name="new_password"]').val(),
            'new_password_repeat':$('#change_password input[name="new_password_repeat"]').val(),
        },
        success: function(data) {
            console.log(data.error);
            if (data.success == true) {
                $('*[data-href="/profile_dynamics"]').click();
                error_modal(data.error, 1);
            } else {
                error_modal(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
});

$(".menu_select ul li").on('click', function() {
    var id = $(this).closest(".menu_select").attr("id");
    console.log(id);
    if($(this).closest(".menu_select").data("sm")){
        $("#"+id+" div>div>span").text($(this).text());
    } else {
        $("#"+id+" div>div>span").text($(this).data("value"));
    }
    $('#'+id+' input').val($(this).data("value"));
});
</script>
@if($dynamics == null)
@include('footer')
@endif