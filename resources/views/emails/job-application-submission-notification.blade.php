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

        .logo {
            margin: 30px 0 10px;
            width: 120px;
            height: auto
        }

        .container {
            width: 80%;
            margin: 20px auto;
            display: flex;
            justify-content: center;
        }

        .left {
            background: #fff;
            text-align: center
        }

        .left,
        .right {
            width: 40%;
        }

        .icon-img-div {
            padding: 30px;
            margin: 0 auto
        }

        .icon-img {
            height: auto;
            width: 60%;
        }

        .right {
            background: #036d53;
            text-align: center;
        }

        .content {
            color: #fff;
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
            .container {
                width: 95%;
                display: block;
                text-align: center;
            }

            .left,
            .right {
                width: 100%;
            }

            .logo-div {
                padding-top: 20px;
            }

            .logo {
                margin: 30px 0 10px;
                width: 120px;
                height: auto
            }

            .left img,
            .right .content {
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>

    <section>
        <div class="container ">
            <div class="content">
                <h2> {{ $title }} </h2>
                <h4>{{ $description }}</h4>



                <p>{{__('email.regards')}}, <br>{{__('email.team')}} {{ config('app.name') }}</p>
            </div>
        </div>
    </section>
</body>

</html>
