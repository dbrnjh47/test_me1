var inproccess = false;
$('body').delegate('.m_open', 'click', function(e) {
    e.preventDefault();
    if (!inproccess) {
        $('.modal').fadeOut(200);
        inproccess = true;
        $('#overlay').fadeIn(300);
        $('#full_container').addClass('blurred');
        t_id = $(this).attr('href');

        target = $(t_id.replace('/', ''));
        target.css({
            'margin-left': target.outerWidth() / 2 * -1,
            'margin-top': target.outerHeight() / 2 * -1,
            'position': 'fixed'
        });
        /*if ($(window).scrollTop() < 100) { 
            target.css('top', 100+$(window).height()/2);
        } else {
            target.css('top', $(window).scrollTop()+$(window).height()/2);
        }            */

        target.fadeIn(300);
        setTimeout(function() {
            $(t_id.replace('/', '') + " .input_one").focus();
            inproccess = false;
        }, 450);

    }
});

$("body").on('click', function(e) {
    var d = e.target;

    if ($(d).closest('.authorization').length) {
        return;
    }

    if (!inproccess && !$(d).hasClass("t-slds__bullet")) {
        $(".authorization").fadeOut(200);
        inproccess = false;
    }
});

$('body').delegate('#overlay, .close', 'click', function(e) {
    if (!inproccess) {
        $('#overlay').fadeOut(400);
        $('.modal').fadeOut(200);
        inproccess = false;
    }
});

function error_modal(e, i = 0) {
    if (!i) {
        $("body").append(`
                <div class="error_modal">
                    <div class="noty_bar noty_type__error noty_theme__bootstrap-v4">
                        <div class="noty_body">` + e + `</div>
                    </div>
                </div>
            `);
    } else {
        $("body").append(`
                <div class="error_modal">
                    <div class="noty_bar noty_type__error noty_theme__bootstrap-v4 success_noty">
                        <div class="noty_body">` + e + `</div>
                    </div>
                </div>
            `);
    }
    $('.error_modal').stop().clearQueue().dequeue().slideDown(700);
    setTimeout(function() {
        $('.error_modal').stop().clearQueue().dequeue().slideUp(700).queue(function() {
            $(this).remove();
        });
    }, 2000);
}

$(".language_smen ul li").on('click', function() {
    console.log($(this).data("locale"));
    $.ajax({
        url: '/locale',
        type: "POST",
        data: {
            'locale': $(this).data("locale")
        },
        success: function(data) {
            if (data.success) {
                location.reload();
            } else {
                error_modal(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
});

// dynamics

function dynamics(e) {
    console.log($(e).data('href'));
    href = ($(e).data('href')).replace("_dynamics", "").replace("home", "");
    $.ajax({
        url: $(e).data('href'),
        type: 'GET',
        success: function(data) {
            window.history.pushState("", "", href);
            $('#content, footer').fadeOut(700);
            var html = $('#hidden_block').html();
            $('#hidden_block').html('');
            $('.header_menu a').removeClass();
            $('.header_menu a[data-href="' + $(e).data('href') + '"]').addClass("activ");
            $('#overlay').fadeOut(400);
            $('.modal').fadeOut(200);
            setTimeout(function() {
                $('#content').html(data);
                setTimeout(function() {
                    $('#content, footer').fadeIn(700);
                    $('#hidden_block').html(html);
                }, 300);
            }, 720);
        },
        error: function(msg) {
            console.log(msg);
        }
    });
}

// dynamics


$("#login_form .button_modal").on('click', function() {
    $("#login_form input").removeClass("error");
    $('#login .error_modal_block').fadeOut(300);
    $.ajax({
        url: '/login',
        type: "POST",
        data: {
            'email': $('#login_form input[name="email"]').val(),
            'password': $('#login_form input[name="pass"]').val(),
        },
        success: function(data) {
            if (data.success == true) {
                window.location.href="/";
            } else {
                if (data.input) {
                    data.input.forEach(function(item, i, arr) {
                        $('#login_form input[name="' + item + '"]').addClass("error");
                    });
                }
                $('#login .error_modal_block p').text(data.error);
                $('#login .error_modal_block').fadeIn(300).css({ 'display': 'flex' });
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
});

$("#signup .button_modal").on('click', function() {
    $("#signup input, #signup .wrapper_checkbox_inout").removeClass("error");
    $('#signup .error_modal_block').fadeOut(300);
    $.ajax({
        url: '/signup',
        type: "POST",
        data: {
            'email': $('#signup input[name="email"]').val(),
            'password': $('#signup input[name="pass"]').val(),
            'name': $('#signup input[name="name"]').val(),
            'currency': $('#signup input[name="currency"]').val(),
            'promo': $('#signup input[name="promo"]').val(),
            'years': $('#years_checkbox_egistration').is(":checked"),
            // 'notifications': $('#notifications_checkbox_egistration').is(":checked"),
        },
        success: function(data) {
            if (data.success == true) {
                window.location.href="/";
            } else {
                if (data.input) {
                    data.input.forEach(function(item, i, arr) {
                        $('#signup input[name="' + item + '"]').addClass("error");
                        if (item == "years") {
                            $('#signup .wrapper_checkbox_inout').addClass("error");
                        }
                    });
                }
                $('#signup .error_modal_block p').text(data.error);
                $('#signup .error_modal_block').fadeIn(300).css({ 'display': 'flex' });
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
});

$(".pol_user_info input").on('click', function() {
    $(".pol_user_info label").removeClass('activ');
    $('.pol_user_info input[type="checkbox"]').prop('checked', false);
    $(this).prop('checked', true);
    $(".pol_user_info label[for=" + $(this).attr('id') + "]").addClass("activ");
});

function update_avatar() {
    var file = $('#update_avatar form input[type="file"]')[0].files[0];
    var formData = new FormData();
    formData.set('img', file);
    $.ajax({
        url: '/update_avatar',
        data: formData,
        contentType: false,
        type: 'POST',
        cache: false,
        processData: false,
        success: function(data) {
            if (data.success == true) {
                $(".header .language.user_heder img").attr("src", data.src);
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
}

function loading_avatar() {
    $(".form_update_file").click();
}

function promo_activ() {
    $.ajax({
        url: '/promo_activ',
        type: "POST",
        data: {
            'promo': $('.promo_activ input').val(),
        },
        success: function(data) {
            console.log(data.error);
            if (data.success == true) {
                if (data.balance_user) {
                    $("#balance_user").text(data.balance_user);
                }

                error_modal(data.error, 1);
            } else {
                error_modal(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
}

$("#signup .language ul li").on('click', function() {
    console.log($(this).data("currency"));
    $("#signup .language p span").text($(this).data("currency"));
    $('#signup input[name="currency"]').val($(this).data("currency"));
    $("#signup .language ul").fadeOut(0);
    setTimeout(function() {
        $("#signup .language ul").fadeIn(50);
    }, 100);
});


function earch_providers() {
    if ($(".providers").css("display") != "none") {
        $("#earch_providers").removeClass('activ');
        $(".providers").slideUp();
    } else {
        $("#earch_providers").addClass("activ");
        $(".providers").slideDown();
    }
}

function show_wrapper_rigft_block(e) {
    console.log($(e).data('id'));
    if ($($(e).data('id')).css("display") != "none") {
        $($(e).data('id')).slideUp();
        $(e).addClass("activ");
        localStorage.setItem($(e).data('id'), 1);
    } else {
        $($(e).data('id')).slideDown();
        $(e).removeClass("activ");
        localStorage.removeItem($(e).data('id'));
    }
}

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

$("#recovery_mail .button_modal, #recovery_mail .span_login p").on('click', function() {
    $('#recovery_mail input[name="email"]').removeClass("error");
    $('#recovery_mail .error_modal_block').removeClass("activ").fadeOut(100);
    $.ajax({
        url: '/reset',
        type: "POST",
        data: {
            'email': $('#recovery_mail input[name="email"]').val(),
        },
        success: function(data) {
            if (data.success) {
                $('#recovery_mail .error_modal_block').addClass("activ").html(`
                    <input type="text" placeholder="Введите код с почты" name="code">
                    <div class="error_modal_block_str">
                        <div onclick="recovery_mail(this);">
                            <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.6998 0L0.299805 1.4L4.8998 6L0.299805 10.6L1.6998 12L7.69981 6L1.6998 0Z" fill="white"/>
                            </svg>
                        </div>  
                    </div>
                    `).fadeIn(300).css({ 'display': 'flex' });

                error_modal(data.error, 1);
            } else {
                $('#recovery_mail input[name="email"]').addClass("error");
                $('#recovery_mail .error_modal_block').html(`
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
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
                    <p></p>
                    `).fadeIn(300).css({ 'display': 'flex' });
                $('#recovery_mail .error_modal_block p').text(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
});

$("#recovery_telephone .button_modal, #recovery_telephone .span_login p").on('click', function() {
    $('#recovery_telephone input[name="telephone"]').removeClass("error");
    $('#recovery_telephone .error_modal_block').removeClass("activ").fadeOut(100);
    $.ajax({
        url: '/recovery_telephone',
        type: "GET",
        data: {
            'email': $('#recovery_telephone input[name="telephone"]').val(),
        },
        success: function(data) {
            if (data.success) {
                $('#recovery_telephone .error_modal_block').addClass("activ").html(`
                    <input type="text" placeholder="Введите код с смс" name="code">
                    <div class="error_modal_block_str">
                        <div onclick="recovery_telephone(this);">
                            <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.6998 0L0.299805 1.4L4.8998 6L0.299805 10.6L1.6998 12L7.69981 6L1.6998 0Z" fill="white"/>
                            </svg>
                        </div>  
                    </div>
                    `).fadeIn(300).css({ 'display': 'flex' });

                error_modal(data.error, 1);
            } else {
                $('#recovery_telephone input[name="telephone"]').addClass("error");
                $('#recovery_telephone .error_modal_block').html(`
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
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
                    <p></p>
                    `).fadeIn(300).css({ 'display': 'flex' });
                $('#recovery_telephone .error_modal_block p').text(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
});

$(".language ul li").on('click', function() {
    $(this).parent(".language ul").fadeOut(0);
    setTimeout(function() {
        $(".language ul").fadeIn(10);
    }, 300);
});

var code_pass;
function recovery_mail(e){
    $.ajax({
        url: '/check_pass',
        type: "POST",
        data: {
            'email': $('#recovery_mail input[name="email"]').val(),
            'code': $('#recovery_mail .error_modal_block input[name="code"]').val(),
        },
        success: function(data) {
            if (data.success) {
                error_modal(data.error, 1);
                code_pass = $('#recovery_mail .error_modal_block input[name="code"]').val();
                $('#recovery_mail .error_modal_block .error_modal_block_str>div').attr("onclick", "recovery_mail_next();");
                $('#recovery_mail .error_modal_block input[name="code"]').attr("placeholder", "Введите новый пароль").val('');
            } else {
                error_modal(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
}

function recovery_mail_next(e){
    $.ajax({
        url: '/check_pass_next',
        type: "POST",
        data: {
            'email': $('#recovery_mail input[name="email"]').val(),
            'code': code_pass,
            'pass': $('#recovery_mail .error_modal_block input[name="code"]').val(),
        },
        success: function(data) {
            if (data.success) {
                window.location.href="/";
            } else {
                error_modal(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
}

function recovery_telephone(e){
    $.ajax({
        url: '/check_pass',
        type: "POST",
        data: {
            'email': $('#recovery_telephone input[name="telephone"]').val(),
            'code': $('#recovery_telephone .error_modal_block input[name="code"]').val(),
        },
        success: function(data) {
            if (data.success) {
                error_modal(data.error, 1);
                code_pass = $('#recovery_telephone .error_modal_block input[name="code"]').val();
                $('#recovery_telephone .error_modal_block .error_modal_block_str>div').attr("onclick", "recovery_telephone_next();");
                $('#recovery_telephone .error_modal_block input[name="code"]').attr("placeholder", "Введите новый пароль").val('');
            } else {
                error_modal(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
}

function recovery_telephone_next(e){
    $.ajax({
        url: '/check_pass_next',
        type: "POST",
        data: {
            'email': $('#recovery_telephone input[name="telephone"]').val(),
            'code': code_pass,
            'pass': $('#recovery_telephone .error_modal_block input[name="code"]').val(),
        },
        success: function(data) {
            if (data.success) {
                window.location.href="/";
            } else {
                error_modal(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
}

$('.refill_modal .item_refill_wrapper .item_refill[href="#refill_pay"]').on('click', function() {
    $('#refill_pay .refill_crypt_wrapper_choice img').attr("src", $(this).data("img"));
    $('#refill_pay .refill_crypt_wrapper_wallet .refill_crypt_wrapper_choice_button').attr('data-payment', $(this).data("payment"));
});


$('#refill_pay .refill_crypt_wrapper_wallet .refill_crypt_wrapper_choice_button').on('click', function() {
    $.ajax({
        url: '/payment/create',
        type: "GET",
        data: {
            'sum': $('#refill_pay input[name="sum"]').val(),
            'system': $(this).data('payment'),
        },
        success: function(data) {
            if (data.success) {
                window.location.href = data.link;
            } else {
                error_modal(data.error);
            }
        },
        error: function(msg) {
            console.log(msg);
        }
    });
});

$('.refill_crypt_button_sum div').on('click', function() {
    $('#' + $(this).closest(".refill_modal").attr("id") + ' input[name="sum"]').val($(this).data("sum"));
});
