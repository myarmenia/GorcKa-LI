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
            width: 46px;
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

        @media (max-width: 768px) {
            .container {
                width: 95%;
                display: block;
                text-align: center;
            }

            .left, .right {
                width: 100%;
            }
            .logo-div{
                padding-top: 20px;
            }
            .logo{
                margin: 30px 0 10px;
                width: 46px;
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

    <section >
        <div class="container ">


            <div>
                <h1>Список сгенерированных реферальных кодов</h1>

                <table border="1" cellpadding="5" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Источник</th>
                            <th>Код</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($codes as $key => $code)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $code['source'] }}</td>
                                <td>{{ $code['code'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>
