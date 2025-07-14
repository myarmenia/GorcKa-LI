<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        section {
            margin: 0 auto;
            width: 60%;
            background: #0485651a;
            padding: 20px 0;
        }
        .nav{
            background: #048565;
            padding: 0 10px;
        }

        .logo {
            margin: 10px 0 10px;
            width: 120px;
            height: auto
        }

        .container,.logo-div {
            width: 80%;
            margin: 20px auto;
            display: flex;
            justify-content: center;
        }

        .content {
            color: #111;
            padding: 30px 6px;
        }

        .btn {
            margin: 30px 0;
            display: inline-block;
            padding: 10px 20px;
            background: #fff;
            color: #3F414D !important;
            text-decoration: none;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            section {
                margin: 0 auto;
                width: 90%;
                background: #0485651a;
                padding: 20px 0;
            }
            .container {
                width: 95%;
                display: block;
                text-align: center;
            }
            .logo {
                width: 120px;
                height: auto
            }
        }
    </style>
</head>

<body>

    <section>
        <div class="nav">
            <div class="logo-div"><img class="logo" src="{{ $message->embed(public_path('/assets/user/images/logo-dark.png')) }}"></div>
        </div>
        <div class="container ">
            <div class="content">
                <h2>Имя: {{ $name }}  </h2>
                <h2>Электронная почта: {{ $email }}  </h2>
                <h2>Тема: {{ $subject }}  </h2>
                <h2>Сообщение: {{ $your_message }}  </h2>


                <p>{{__('email.regards')}}, <br>{{__('email.team')}} {{ config('app.name') }}</p>
            </div>
        </div>
    </section>
</body>

</html>
