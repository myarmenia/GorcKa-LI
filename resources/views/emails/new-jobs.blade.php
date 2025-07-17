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

        /*  */
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 16px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            position: relative;
            width: 700px;
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

}

.card-header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.card-icon {
    background-color: #d4ede5;
    border-radius: 8px;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}



.card-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    color: #777;
    font-size: 14px;
}

.card-status {
    background-color: #d4ede5;
    padding: 4px 10px;
    border-radius: 6px;
    color: #026c52;
    font-size: 13px;
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

.card-date {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #888;
}

    </style>
</head>

<body>

    <section>
        <div class="nav">
            {{-- <div class="logo-div"><img class="logo" src="{{ $message->embed(public_path('/assets/user/images/logo-dark.png')) }}"></div> --}}
        </div>
        <div class="container ">
            <div class="content">
                {{-- @dd($tasks ) --}}

                @foreach ($tasks as $task )
                    <a href="#" style="text-decoration: none; color: inherit;">
                        <div class="card">
                            <div class="card-header">

                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse;">
                                    <tr>
                                        <td width="33%" align="center">

                                            @php
                                                $iconPath = '/assets/user/icons/categories/' .
                                                            ($task->sub_category->category->icon ?? 'it') . '.svg';


                                            @endphp


                                            {{-- <img src="{{ $message->embed(public_path($iconPath)) }}"
                                                alt="Category Icon"
                                                style="display: block; width: 100px; border-radius: 12px;" /> --}}
                                        </td>

                                        <td style="padding-left: 10px;">
                                            <strong>{{ $task->title }}</strong><br>

                                        </td>
                                        <td style="padding-left: 10px;">

                                            📍 {{ $task->location->translation($userLang)->first()?->name }}<br>

                                        </td>
                                        <td style="padding-left: 10px;">

                                            {{ $task->price_min }} –{{ $task->price_max }} (֏)<br>

                                        </td>

                                    </tr>
                                </table>
                            </div>

                            <div class="card-footer">
                                {{-- @dd($userLang) --}}
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size: 14px; color: #555; border-top: 1px solid #f1f1f1;">
                                <tr style="background-color: #f5f5f5;">
                                    <td align="left" style="padding: 8px;">🕒  {{ $task->start_date }} - {{$task->end_date  }}</td>
                                    <td align="right" style="padding: 8px;">
                                    <a href="{{ route('single_job', ['locale' => $userLang, 'id' => $task->id]) }}" style="color: #222; text-decoration: none; font-weight: 600;">{{ __('for_vue.apply_now') }} <span> »</span></a>
                                    </td>
                                </tr>
                                </table>
                            </div>
                        </div>
                    </a>
                @endforeach




                <p>{{__('email.regards')}}, <br>{{__('email.team')}} {{ config('app.name') }}</p>
            </div>
        </div>
    </section>
</body>

</html>
