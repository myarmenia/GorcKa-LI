<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse;">
    @foreach ($tasks as $task )

        <tr>
            <td>
                 <a href="#" style="text-decoration: none; color: inherit;">
                        <div class="card">
                            <div class="card-header">

                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse;">
                                    <tr>
                                        <td width="33%" align="center">

                                            @php
                                                $iconPath = '/assets/user/icons/categories/' .
                                                            ($task->sub_category->category->icon ?? 'it') . '.png';


                                            @endphp


                                            <img src="{{ $message->embed(public_path($iconPath)) }}"
                                                alt="Category Icon"
                                                style="display: block; width: 100px; border-radius: 12px;" />
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
                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size: 14px; color: #555; border-top: 1px solid #f1f1f1;">
                                <tr style="background-color: #f5f5f5;">
                                    <td align="left" style="padding: 8px;">🕒  {{ $task->start_date }} - {{$task->end_date  }}</td>
                                    <td align="right" style="padding: 8px;">
                                        <a href="{{ route('single_job', ['locale' => $userLang, 'id' => $task->id]) }}">
                                            {{ __('for_vue.apply_now') }}
                                             <span> »</span></a>
                                       
                                    </td>
                                </tr>
                                </table>
                            </div>
                        </div>
                    </a>
            </td>
        </tr>
    @endforeach
</table>
