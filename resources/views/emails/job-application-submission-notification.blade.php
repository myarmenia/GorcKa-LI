<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background: #0485651a;
        }
         section {

            margin: 0 auto;
            width: 60%;
            padding: 20px 0;

        }
      .logo {
            margin: 10px 0 10px;
            width: 46px;
            height: auto
        }
        .container {
            max-width: 800px;
            min-height: 200px;
            margin: 0 auto;
            padding: 15px;
            border-radius:8px

        }
       .rounded-table {
            border: 2px solid black;
            border-radius: 10px;
            border-collapse: separate; /* обязательно! */
            border-spacing: 0; /* убрать зазоры */
            overflow: hidden; /* для некоторых браузеров */
        }

        .rounded-table td {
            border: none; /* убрать внутренние границы */
            padding: 10px;
        }

    </style>
</head>

<body>

    <section>

         <table width="100%" cellpadding="0" cellspacing="0" border="0" class="rounded-table">
                <tr>
                    <td align="center">
                        <a href="{{ route('welcome',['locale'=>$userLang]) }}">
                            <img class="logo"  width="50" src="{{ $message->embed(public_path('/assets/user/images/logo.png')) }}">
                        </a>
                    </td>
                </tr>
                <tr align="center">
                    <h2> {{ $title }}  </h2>
                </tr>
                <tr>
                    <td>
                        <div class="container">
                            <h3>{{__('email.jobname')}}։
                                <a href="{{ url('/' . app()->getLocale() . '/single-jobe/' . $task->id) }}"> {{ $task->title }} </a>
                            </h3>
                            <h3>{{ $description }} </h3>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="center"    style="height:125px; background-color: #27272a; color: #ffffff;">

                         <x-email.social-links :message="$message"/>



                    </td>

                </tr>

            </table>
    </section>
</body>

</html>
