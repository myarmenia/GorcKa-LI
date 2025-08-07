<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
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

        .content {
            color: #111;
            padding: 30px 6px;
        }










    </style>
</head>

<body>

    <section>
        {{-- <div class="container "> --}}
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td align="center">
                        <a href="{{ route('welcome',['locale'=>$userLang]) }}">
                            <img class="logo"  width="50" src="{{ $message->embed(public_path('/assets/user/images/logo.png')) }}">
                        </a>
                    </td>
                </tr>
                <tr >
                    <td align="center">
                        <h2>{{ __('for_vue.new_jobs') }}</h2>


                      </td>
                </tr>
                <tr>

                    <td>
                        <x-email.single-job :tasks="$tasks" :message="$message" :userLang="$userLang"/>
                    </td>
                </tr>


                <tr>
                    <td align="center"    style="height:125px; background-color: #27272a; color: #ffffff;">

                         <x-email.social-links :message="$message"/>



                    </td>

                </tr>

            </table>

        {{-- </div> --}}
    </section>
</body>

</html>

