<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="autor" content="">
    <link rel="stylesheet" href="/temple/css/style.css?{{time()}}">
    <script type="text/javascript" src="/temple/js/jqeri.js"></script>
    <link rel="stylesheet" href="/temple/css/aos.css">
    <link rel="stylesheet" type="text/css" href="/temple/css/slick.css?{{time()}}" />
    <link rel="stylesheet" href="/temple/css/data.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
    <div id="overlay"></div>
    @if(!Auth::check())
    <div class="modal" id="login">
        <div class="inout_block" id="login_form">
            <div class="modal_h1">
                <h1>Войти</h1>
                <svg class="close" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 1.3L11.7 0L6.5 5.2L1.3 0L0 1.3L5.2 6.5L0 11.7L1.3 13L6.5 7.8L11.7 13L13 11.7L7.8 6.5L13 1.3Z" fill="white" />
                </svg>
            </div>
            <input class="input_one" type="text" placeholder="Email / Телефон" name="email">
            <input type="password" placeholder="Пароль" name="pass">
            <div class="button_modal">Войти</div>
            <span class="span_login"><a data-href="/restore_dynamics" onclick="dynamics(this);">Не помнишь пароль?</a></span>
            <span>Еще нет аккаунта? <a href="#signup" class="m_open">Зарегистрируйся</a></span>
        </div>
        <div class="inout_block error_modal_block">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0)">
                    <path d="M19.3565 19.7276H1.64366C0.376977 19.7276 -0.412656 18.3545 0.226491 17.2595L9.08287 2.08648C9.71562 1.00243 11.2833 1.00046 11.9172 2.08648L20.7736 17.2595C21.4122 18.3535 20.6243 19.7276 19.3565 19.7276Z" fill="#FF6B6B" />
                    <path d="M10.2859 2.78858L1.42947 17.9617C1.33264 18.1276 1.45129 18.3349 1.64378 18.3349H19.3566C19.5487 18.3349 19.6679 18.1279 19.5709 17.9617L10.7145 2.78858C10.6186 2.62435 10.3823 2.62337 10.2859 2.78858Z" fill="#EE5253" />
                    <path d="M10.5045 14.689C10.9138 14.689 11.2596 15.0296 11.2596 15.4327C11.2596 15.8306 10.9138 16.1667 10.5045 16.1667C10.0832 16.1667 9.74048 15.8374 9.74048 15.4327C9.74048 15.0296 10.0903 14.689 10.5045 14.689Z" fill="#E4EAF8" />
                    <path d="M10.5045 13.5406C10.0808 13.5406 9.78491 13.3354 9.78491 13.0416V8.89304C9.78491 8.64735 10.0741 8.38428 10.5045 8.38428C10.8925 8.38428 11.233 8.62204 11.233 8.89304V13.0416C11.233 13.3308 10.9266 13.5406 10.5045 13.5406Z" fill="#E4EAF8" />
                    <path d="M1.07153 17.2595L9.92792 2.08638C10.152 1.70244 10.5082 1.43526 10.9225 1.32677C10.2318 1.14594 9.47256 1.41857 9.08279 2.08638L0.226405 17.2595C-0.412167 18.3534 0.375743 19.7276 1.64358 19.7276H2.4887C1.22194 19.7275 0.432427 18.3543 1.07153 17.2595Z" fill="#EE5253" />
                    <path d="M2.27437 17.9616L10.9225 3.14537L10.7142 2.78858C10.6182 2.62402 10.3819 2.6237 10.2856 2.78858L1.42925 17.9616C1.33237 18.1276 1.45107 18.3349 1.64355 18.3349H2.48868C2.29652 18.3349 2.17733 18.1279 2.27437 17.9616Z" fill="#E24951" />
                    <path d="M10.5856 15.4327C10.5856 15.1813 10.7217 14.9543 10.9246 14.8189C10.8036 14.7373 10.6585 14.689 10.5045 14.689C10.0903 14.689 9.74048 15.0296 9.74048 15.4327C9.74048 15.8375 10.0832 16.1668 10.5045 16.1668C10.6573 16.1668 10.8012 16.1198 10.9216 16.0404C10.7189 15.9083 10.5856 15.6852 10.5856 15.4327Z" fill="#D8DCE5" />
                    <path d="M10.63 13.0416V8.89304C10.63 8.74144 10.7404 8.58345 10.9258 8.48452C10.805 8.42226 10.6587 8.38428 10.5045 8.38428C10.0741 8.38428 9.78491 8.64735 9.78491 8.89304V13.0416C9.78491 13.3354 10.0808 13.5406 10.5045 13.5406C10.6658 13.5406 10.81 13.5098 10.9269 13.4558C10.7423 13.3692 10.63 13.2223 10.63 13.0416Z" fill="#D8DCE5" />
                </g>
                <defs>
                    <clipPath id="clip0">
                        <rect width="21" height="21" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <p>Согласитесь с правилами и политикой!</p>
        </div>
    </div>
    <div class="modal" id="signup">
        <div class="h_text_modal">
            <p>МЫ УВЕЛИЧИМ ТВОЙ ДЕПОЗИТ ДО 1 BTC</p>
            <span>+ 180 Фриспинов</span>
        </div>
        <div class="inout_block">
            <div class="modal_h1">
                <h1>РЕГИСТРАЦИЯ</h1>
                <svg class="close" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 1.3L11.7 0L6.5 5.2L1.3 0L0 1.3L5.2 6.5L0 11.7L1.3 13L6.5 7.8L11.7 13L13 11.7L7.8 6.5L13 1.3Z" fill="white" />
                </svg>
            </div>
            <input class="input_one" type="text" placeholder="Email / Телефон" name="email">
            <input type="text" placeholder="Никнейм" name="name">
            <input type="password" placeholder="Пароль" name="pass">
            <input type="hidden" name="currency" value="{{$currency[0]->name}}">
            <div class="language">
                <div>
                    <p>Валюта: <span>{{$currency[0]->name}}</span></p>
                    <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.366116 0.536342C0.854272 0.0751514 1.64573 0.0751514 2.13388 0.536342L5 3.24414L7.86612 0.536342C8.35427 0.0751511 9.14573 0.0751511 9.63388 0.536342C10.122 0.997532 10.122 1.74527 9.63388 2.20646L5.88388 5.74932C5.39573 6.21051 4.60427 6.21051 4.11612 5.74932L0.366116 2.20646C-0.122039 1.74527 -0.122039 0.997533 0.366116 0.536342Z" fill="#686D87"></path>
                    </svg>
                </div>
                <ul>
                    @foreach ($currency as $c)
                        <li data-currency="{{$c->name}}"><span>{{$c->name}}</span></li>
                    @endforeach
                </ul>
            </div>
            <input type="text" placeholder="Промокод (необязательно)" name="promo">
            <div class="checkbox_inout_block">
                <div class="wrapper_checkbox_inout" style="margin-right: 15px;margin-top: 4px;">
                    <input type="checkbox" class="checkbox_input" id="years_checkbox_egistration" required="">
                    <label for="years_checkbox_egistration"></label>
                </div>
                <label for="years_checkbox_egistration">Я подтверждаю согласие с <span>Правилами</span> и <span>условиямии Политикой конфиденциальности</span></label>
            </div>
            <div class="button_modal">Создать аккаунт</div>
            <span>Уже есть аккаунт? <a class="m_open" href="#login">Войти</a></span>
        </div>
        <div class="inout_block error_modal_block">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0)">
                    <path d="M19.3565 19.7276H1.64366C0.376977 19.7276 -0.412656 18.3545 0.226491 17.2595L9.08287 2.08648C9.71562 1.00243 11.2833 1.00046 11.9172 2.08648L20.7736 17.2595C21.4122 18.3535 20.6243 19.7276 19.3565 19.7276Z" fill="#FF6B6B" />
                    <path d="M10.2859 2.78858L1.42947 17.9617C1.33264 18.1276 1.45129 18.3349 1.64378 18.3349H19.3566C19.5487 18.3349 19.6679 18.1279 19.5709 17.9617L10.7145 2.78858C10.6186 2.62435 10.3823 2.62337 10.2859 2.78858Z" fill="#EE5253" />
                    <path d="M10.5045 14.689C10.9138 14.689 11.2596 15.0296 11.2596 15.4327C11.2596 15.8306 10.9138 16.1667 10.5045 16.1667C10.0832 16.1667 9.74048 15.8374 9.74048 15.4327C9.74048 15.0296 10.0903 14.689 10.5045 14.689Z" fill="#E4EAF8" />
                    <path d="M10.5045 13.5406C10.0808 13.5406 9.78491 13.3354 9.78491 13.0416V8.89304C9.78491 8.64735 10.0741 8.38428 10.5045 8.38428C10.8925 8.38428 11.233 8.62204 11.233 8.89304V13.0416C11.233 13.3308 10.9266 13.5406 10.5045 13.5406Z" fill="#E4EAF8" />
                    <path d="M1.07153 17.2595L9.92792 2.08638C10.152 1.70244 10.5082 1.43526 10.9225 1.32677C10.2318 1.14594 9.47256 1.41857 9.08279 2.08638L0.226405 17.2595C-0.412167 18.3534 0.375743 19.7276 1.64358 19.7276H2.4887C1.22194 19.7275 0.432427 18.3543 1.07153 17.2595Z" fill="#EE5253" />
                    <path d="M2.27437 17.9616L10.9225 3.14537L10.7142 2.78858C10.6182 2.62402 10.3819 2.6237 10.2856 2.78858L1.42925 17.9616C1.33237 18.1276 1.45107 18.3349 1.64355 18.3349H2.48868C2.29652 18.3349 2.17733 18.1279 2.27437 17.9616Z" fill="#E24951" />
                    <path d="M10.5856 15.4327C10.5856 15.1813 10.7217 14.9543 10.9246 14.8189C10.8036 14.7373 10.6585 14.689 10.5045 14.689C10.0903 14.689 9.74048 15.0296 9.74048 15.4327C9.74048 15.8375 10.0832 16.1668 10.5045 16.1668C10.6573 16.1668 10.8012 16.1198 10.9216 16.0404C10.7189 15.9083 10.5856 15.6852 10.5856 15.4327Z" fill="#D8DCE5" />
                    <path d="M10.63 13.0416V8.89304C10.63 8.74144 10.7404 8.58345 10.9258 8.48452C10.805 8.42226 10.6587 8.38428 10.5045 8.38428C10.0741 8.38428 9.78491 8.64735 9.78491 8.89304V13.0416C9.78491 13.3354 10.0808 13.5406 10.5045 13.5406C10.6658 13.5406 10.81 13.5098 10.9269 13.4558C10.7423 13.3692 10.63 13.2223 10.63 13.0416Z" fill="#D8DCE5" />
                </g>
                <defs>
                    <clipPath id="clip0">
                        <rect width="21" height="21" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <p>Согласитесь с правилами и политикой!</p>
        </div>
    </div>
    @endif
    <div class="header" data-aos="fade-down" data-aos-delay="0">
        <div class="wrapper">
            <div class="logo" id="logo" data-href="/home_dynamics" onclick="dynamics(this);"><span>{{$settings->project_name[0]}}</span>{{substr($settings->project_name, 1)}}</div>
            <div class="header_menu">
                <a>Акции</a>
                <a>Бонусы</a>
                <a>Турниры</a>
                <a>О нас</a>
                <a>Поддержка</a>
            </div>
            <div class="header_menu_entrance">
                <p>Войти через:</p>
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="16" cy="16" r="16" fill="#3B5998" />
                    <path d="M17.2332 13.2426V11.864C17.2332 11.657 17.2427 11.4967 17.2621 11.3835C17.2813 11.2701 17.3252 11.1586 17.3933 11.0485C17.4613 10.9384 17.5713 10.8624 17.7233 10.8203C17.8755 10.7782 18.0778 10.7572 18.3303 10.7572H19.7089V8H17.505C16.2298 8 15.314 8.30255 14.7573 8.90764C14.2007 9.51287 13.9224 10.4044 13.9224 11.5824V13.2426H12.2717V15.9999H13.9223V23.9999H17.2332V16H19.4369L19.7282 13.2426H17.2332Z" fill="white" />
                </svg>
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="16" cy="16" r="16" fill="#F44336" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.7257 10.0226C8.29244 10.2381 6.14098 11.9746 5.33041 14.3773C5.0838 15.1083 5 15.6471 5 16.5019C5 17.3567 5.0838 17.8955 5.33041 18.6265C6.26855 21.4073 8.91955 23.2037 11.7572 22.9815C13.2808 22.8621 14.637 22.2175 15.7145 21.1006C16.6285 20.153 17.1934 19.084 17.4651 17.7872C17.535 17.4534 17.5564 17.1742 17.5723 16.3854L17.5922 15.4005H14.4464H11.3005V16.5019V17.6034H13.333C14.6856 17.6034 15.3654 17.6178 15.3654 17.6465C15.3654 17.7472 15.1494 18.3157 15.0131 18.5737C13.9149 20.6519 11.3245 21.4417 9.30042 20.3153C7.12046 19.1021 6.42105 16.2277 7.79011 14.1084C8.2033 13.4687 8.78689 12.9467 9.47333 12.6027C10.132 12.2726 10.4475 12.2036 11.3005 12.2027C11.9245 12.2021 12.0646 12.2148 12.3653 12.2996C12.9961 12.4774 13.4613 12.7384 13.9728 13.2011L14.2431 13.4456L14.9715 12.6932L15.6999 11.9408L15.4726 11.7264C14.1605 10.4891 12.438 9.87089 10.7257 10.0226ZM21.8119 14.3195V15.399L20.7546 15.4103L19.6973 15.4216V16.5019V17.5822L20.7546 17.5935L21.8119 17.6048V18.6844V19.7639H22.8589H23.9059V18.6836V17.6034H24.953H26V16.5019V15.4005H24.953H23.9059V14.3202V13.2399H22.8589H21.8119V14.3195Z" fill="white" />
                </svg>
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="16" cy="16" r="16" fill="#1E88E5" />
                    <g clip-path="url(#clip0)">
                        <path d="M15.8288 20.5261H16.7849C16.7849 20.5261 17.0739 20.4941 17.2209 20.3351C17.3569 20.1891 17.3519 19.9151 17.3519 19.9151C17.3519 19.9151 17.3329 18.632 17.929 18.443C18.516 18.257 19.2701 19.6831 20.0691 20.2321C20.6732 20.6471 21.1322 20.5561 21.1322 20.5561L23.2694 20.5261C23.2694 20.5261 24.3874 20.4571 23.8574 19.5781C23.8144 19.506 23.5484 18.928 22.2683 17.7399C20.9282 16.4958 21.1082 16.6978 22.7223 14.5467C23.7054 13.2366 24.0984 12.4365 23.9754 12.0945C23.8584 11.7685 23.1353 11.8545 23.1353 11.8545L20.7312 11.8685C20.7312 11.8685 20.5532 11.8445 20.4201 11.9235C20.2911 12.0015 20.2081 12.1815 20.2081 12.1815C20.2081 12.1815 19.8271 13.1956 19.3191 14.0576C18.248 15.8768 17.819 15.9728 17.6439 15.8598C17.2369 15.5968 17.3389 14.8017 17.3389 14.2377C17.3389 12.4745 17.6059 11.7395 16.8179 11.5495C16.5559 11.4865 16.3638 11.4444 15.6948 11.4374C14.8367 11.4284 14.1097 11.4404 13.6986 11.6415C13.4246 11.7755 13.2136 12.0745 13.3426 12.0915C13.5016 12.1125 13.8617 12.1885 14.0527 12.4485C14.2997 12.7835 14.2907 13.5376 14.2907 13.5376C14.2907 13.5376 14.4327 15.6128 13.9597 15.8708C13.6346 16.0478 13.1896 15.6868 12.2345 14.0356C11.7455 13.1906 11.3755 12.2555 11.3755 12.2555C11.3755 12.2555 11.3045 12.0815 11.1775 11.9885C11.0234 11.8755 10.8074 11.8395 10.8074 11.8395L8.52126 11.8535C8.52126 11.8535 8.17824 11.8635 8.05223 12.0125C7.94022 12.1455 8.04323 12.4195 8.04323 12.4195C8.04323 12.4195 9.83336 16.6068 11.8595 18.718C13.7186 20.6531 15.8288 20.5261 15.8288 20.5261Z" fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <rect width="16" height="16" fill="white" transform="translate(8 8)" />
                        </clipPath>
                    </defs>
                </svg>
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="16" cy="16" r="16" fill="#CD2A00" />
                    <path d="M18.3591 8H16.0859C13.7828 8 11.4588 9.70069 11.4588 13.5002C11.4588 15.4682 12.2929 17.001 13.8219 17.8728L11.0234 22.9381C10.8907 23.1777 10.8873 23.4492 11.0141 23.6643C11.138 23.8745 11.3644 24 11.6197 24H13.0353C13.3569 24 13.6077 23.8446 13.7279 23.5723L16.3518 18.44H16.5433V23.3603C16.5433 23.7071 16.8359 24 17.1823 24H18.419C18.8074 24 19.0785 23.7288 19.0785 23.3405V8.70009C19.0786 8.28791 18.7828 8 18.3591 8ZM16.5433 16.1602H16.2055C14.8957 16.1602 14.1137 15.091 14.1137 13.3001C14.1137 11.0732 15.1015 10.2798 16.026 10.2798H16.5433V16.1602Z" fill="white" />
                </svg>
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="16" cy="16" r="16" fill="#039BE5" />
                    <path d="M16 32C24.8366 32 32 24.8366 32 16C32 7.16344 24.8366 0 16 0C7.16344 0 0 7.16344 0 16C0 24.8366 7.16344 32 16 32Z" fill="#039BE5" />
                    <path d="M7.32144 15.6533L22.7481 9.7053C23.4641 9.44664 24.0894 9.87997 23.8574 10.9626L23.8588 10.9613L21.2321 23.336C21.0374 24.2133 20.5161 24.4266 19.7868 24.0133L15.7868 21.0653L13.8574 22.924C13.6441 23.1373 13.4641 23.3173 13.0508 23.3173L13.3348 19.2466L20.7481 12.5493C21.0708 12.2653 20.6761 12.1053 20.2508 12.388L11.0894 18.156L7.14011 16.924C6.28277 16.652 6.26411 16.0666 7.32144 15.6533Z" fill="white" />
                </svg>
            </div>
            <div class="header_entrance">
                <div class="button_entrance m_open" href="#login">Войти</div>
                <div class="button_entrance button_registration m_open" href="#signup">Регистрация</div>
            </div>
            <div class="language language_smen">
                <div>
                    <div><img @if($locale) src="/temple/imgs/languages/{{$locale}}.png" @else src="/temple/imgs/languages/en.png" @endif alt="">
                        <span>{{$locale}}</span>
                        <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.366116 0.536342C0.854272 0.0751514 1.64573 0.0751514 2.13388 0.536342L5 3.24414L7.86612 0.536342C8.35427 0.0751511 9.14573 0.0751511 9.63388 0.536342C10.122 0.997532 10.122 1.74527 9.63388 2.20646L5.88388 5.74932C5.39573 6.21051 4.60427 6.21051 4.11612 5.74932L0.366116 2.20646C-0.122039 1.74527 -0.122039 0.997533 0.366116 0.536342Z" fill="#686D87" />
                        </svg>
                    </div>
                </div>
                <ul>
                    <li data-locale="en"><img src="/temple/imgs/languages/en.png" alt=""><span>en</span></li>
                    <li data-locale="ru"><img src="/temple/imgs/languages/ru.png" alt=""><span>ru</span></li>
                    <li data-locale="pa"><img src="/temple/imgs/languages/pa.png" alt=""><span>pa</span></li>
                    <li data-locale="id"><img src="/temple/imgs/languages/id.png" alt=""><span>id</span></li>
                    <li data-locale="in"><img src="/temple/imgs/languages/in.png" alt=""><span>in</span></li>
                    <!-- <li data-locale="ch"><img src="/temple/img/languages/ch.png" alt=""></li> -->
                </ul>
            </div>
        </div>
    </div>
    <div class="content" id="content">
        @yield('content')
    </div>
    <footer>
        <hr>
        <div class="slds_slick">
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
            <div>
                <div class="provider"></div>
            </div>
        </div>
        <div class="footer_menu">
            <a>Правила и условия</a>
            <a class="{{ Request::is('bonuses_rules') ? 'activ' : '' || Request::is('bonuses_rules_dynamics') ? 'activ' : ''}}" data-href="/bonuses_rules_dynamics" onclick="dynamics(this);">Бонусная политика</a>
            <a>Политика конфиденциальности</a>
            <a>Противодействие отмыванию денег</a>
            <a class="{{ Request::is('contacts') ? 'activ' : '' || Request::is('contacts_dynamics') ? 'activ' : ''}}" data-href="/contacts_dynamics" onclick="dynamics(this);">Контакты</a>
            <a>Альтернативные методы пополнения</a>
            <a>Партнерам</a>
            <div class="language">
                <div>
                    <div><img src="/temple/imgs/languages/pa.png" alt=""></div>
                </div>
                <ul>
                    <li data-locale="en"><img src="/temple/imgs/languages/en.png" alt=""></li>
                    <li data-locale="ru"><img src="/temple/imgs/languages/ru.png" alt=""></li>
                    <li data-locale="pa"><img src="/temple/imgs/languages/pa.png" alt=""></li>
                    <li data-locale="id"><img src="/temple/imgs/languages/id.png" alt=""></li>
                    <li data-locale="in"><img src="/temple/imgs/languages/in.png" alt=""></li>
                </ul>
            </div>
        </div>
        <hr style="margin-bottom: 35px;">
        <p class="payment_methods">Методы оплаты</p>
        <hr>
        <div class="footer_last">
            <div class="logo" data-href="/home_dynamics" onclick="dynamics(this);"></div>
            <p>© {{date("Y")}} All rights reserved.</p>
            @if(Auth::check())<div class="button_check button_check_min" data-href="/refill_dynamics" onclick="dynamics(this);">Касса</div>
            @else
            <div class="button_check button_check_min" href="#authorization" onclick="authorization(this);">Авторизация</div>
            @endif
        </div>
        <script type="text/javascript" src="/temple/js/slick.js"></script>
        <script>
        $(document).ready(function() {
            if ($('.slds_slick')) {
                $('.slds_slick').slick({
                    slidesToShow: 9,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                });
            }
        });
        </script>
    </footer>
    <script src="/temple/js/svg4everybody.js"></script>
    <script src="/temple/js/jquery.formstyler.min.js"></script>
    <script src="/temple/js/jquery.nicescroll.min.js"></script>
    <script src="/temple/js/aos.js"></script>
    <script src="/temple/js/app.js?{{time()}}"></script>
    <script type="text/javascript" src="/temple/js/history.js?{{time()}}"></script>
    <script src="/temple/js/tilda-slds-1.4.min.js?{{time()}}"></script>
</body>

</html>