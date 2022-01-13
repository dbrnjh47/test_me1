<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BootStrap-->
    
    <!-- MENU -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
    .main {
        width: 960px;
        height: 850px;
        background-color: #171925;
    }

    .main__back_mr_css_attr{
        margin: auto;
            margin-top: 54px;
    }

    .logo__pismo {
        text-align: center;
        width: 250px;
        height: 58px;
        display: block;
        padding-top: 57px;
        margin: 0 auto;

    }

    .main__back {
        position: absolute;
        width: 808px;
        height: 600px;
        border-radius: 10px;
        background: #1E202E;
        left: 76px;
        margin-top: 54px;
    }

    .tittle__pismo {
        font-family: Montserrat;
        font-style: normal;
        font-weight: bold;
        font-size: 19px;
        white-space: nowrap;
        text-align: center;
        color: #FFFFFF;
        padding-top: 44px;
    }

    .subtittle__pismo {
        font-family: Montserrat;
        font-style: normal;
        font-weight: 500;
        font-size: 15px;
        line-height: 19px;
        text-align: center;
        color: #FFFFFF;
        padding-top: 18px;
    }

    .pin {
        width: 185px;
        height: 80px;
        display: block;
        margin: 0 auto;
        padding-top: 45px;
    }

    .text__pismo {
        white-space: nowrap;
        font-family: Montserrat;
        font-style: normal;
        font-weight: 500;
        font-size: 15px;
        line-height: 19px;
        text-align: center;
        color: #FFFFFF;
        padding-top: 44px;
    }

    .span {
        font-weight: 700;
    }

    .button {
        width: 300px;
        height: 56px;
        margin: 0 auto;
        background-color: #1CB55C;
        padding: 10px 48px;
        border-radius: 10px;
        margin-top: 57px;

    }

    .button__text {
        font-family: Montserrat;
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        text-align: center;
        color: #fff;
    }

    .text__pismo__allert {
        white-space: nowrap;
        font-family: Montserrat;
        font-style: normal;
        font-weight: 500;
        font-size: 15px;
        line-height: 19px;
        text-align: center;
        color: #FFFFFF;
        padding-top: 44px;
    }
    </style>
</head>

<body>
    <div class="main" style="margin: auto;">
        <img src="https://{{$_SERVER['SERVER_NAME']}}/temple/imgs/coins.png" alt="" class="logo__pismo">
        <div class="main__back" style="margin: auto;margin-top: 54px;">
            <h1 class="tittle__pismo">Уважаемый, {{$login}}!</h1>
            <h2 class="subtittle__pismo">Вы запросили восстановить пароль на сайте {{$settings->project_name}}.</h2>
            <img src="img/pin.png" alt="" class="pin">
            <p class="text__pismo">Код для смены пароля: <span class="span">{{$code}}</span></p>

            <p class="text__pismo__allert">Если вы не хотите сбрасывать пароль, просто проигнорируйте это сообщение.
            </p>
        </div>
    </div>
</body>

</html>