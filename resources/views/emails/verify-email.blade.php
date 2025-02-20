<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        section {
            background: #0485651a;
            padding: 20px;
        }

        .logo{
            margin: 30px 0 10px;
            width: 120px;
            height: auto
        }

        .container{
            width: 80%;
            margin: 20px auto;
            display: flex;
            justify-content: center;
        }

        .left{
            background: #fff;
            text-align: center
        }

        .left, .right{
            width: 40%;
        }
        .icon-img-div{
            padding: 30px;
            margin: 0 auto
        }
        .icon-img{
            height: auto;
            width: 60%;
        }

        .right{
            background: #036d53;
            text-align: center;
        }
        .content{
            color: #fff;
            padding: 30px 6px;
        }

        .btn{
            margin: 30px 0;
            display: inline-block;
            padding: 10px 20px;
            background: #fff;
            color: #3F414D !important;
            text-decoration: none;
            border-radius: 5px;
        }

    </style>
</head>
<body>

    <section >
        <div class="container ">
            <div class="left">
                <div><img class="logo" src="{{ $message->embed(public_path('/assets/user/images/logo-dark.png')) }}"></div>
                <div class="icon-img-div"><img class="icon-img" src="{{ $message->embed(public_path('/assets/user/images/subscribe.png')) }}"></div>
            </div>

            <div class="right">
                <div class="content">
                    <h2>Здравствуйте, {{ $user->name }}!  </h2>
                    <h4>Пожалуйста, подтвердите ваш email, нажав на кнопку ниже.</h4>

                    <a class="btn" href="{{ $url }}" style="">Подтвердить Email</a>

                    <p>С уважением, <br>Команда {{ config('app.name') }}</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
