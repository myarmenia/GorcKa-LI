<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        section {
            margin: 0 auto;
            width: 60%;
            /* background: #0485651a; */
            padding: 20px 0;
            /* border:1px solid red; */
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

        /*  */
         .card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 16px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            position: relative;

            margin-bottom: 20px;
            font-family: 'Segoe UI', sans-serif;
            transition: border-color 0.3s ease; /* плавный переход */

        }
         .card:hover {
            border-color: green;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin:5px

        }

        .card-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .card-footer {

            border-top: 1px solid #f1f1f1;
            font-size: 14px;
            color: #555;

        }
        .card-footer a {
            color: #222;
            text-decoration: none;
            font-weight: 600;
        }

        .card-footer a:hover {
            text-decoration: underline;
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

