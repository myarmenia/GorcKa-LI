<?php

namespace App\Helpers;

use App\Models\Category;
use App\Models\Lang;
use App\Models\Location;
use App\Models\NotificationCategory;
use App\Models\NotificCatTrans;
use Illuminate\Support\Collection;
use Request;



class Helper
{

    public static function getLanguages(): Collection
    {

        return Lang::all()->map(function ($lang) {
            $lang->name_uc = ucfirst(strtolower($lang->name)); // "am" → "Am"
            return $lang;
        });
    }


    public static function getLocations(): Collection
    {
        $locations = Location::with([
            'item_translations' => function ($query) {
                $query->where('lang', app()->getLocale());
            }
        ])->get();

        return $locations;
    }

    public static function filterLocations(Request $request)
    {
        $search = $request->get('search', '');  // Получаем параметр поиска

        // Фильтруем данные по полю 'text', учитывая регистр
        $options = Location::with([
            'item_translations' => function ($query) use ($search) {
                $query->where('text', 'like', '%' . $search . '%');
            }
        ])->get();

        return response()->json($options);  // Отправляем отфильтрованные данные
    }


    public static function getCategories(){

        $categories = Category::with([
            'item_translations' => function ($query) {
                $query->where('lang', app()->getLocale());
            }
        ])->get();

        return $categories;
    }

    public static function getCategoriesWithSubCategories()
    {
        $locale = app()->getLocale();

        $categories = Category::with([
            'item_translations' => fn($q) => $q->where('lang', $locale),
            'sub_categories.item_translations' => fn($q) => $q->where('lang', $locale),
        ])->get();

        // Преобразуем результат в нужный формат
        return $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => optional($category->item_translations->first())->name ?? 'Без названия',
                'color' => $category->color ?? null,
                'sub_categories' => $category->sub_categories->map(function ($sub) {
                    return [
                        'id' => $sub->id,
                        'name' => optional($sub->item_translations->first())->name ?? 'Без названия',
                    ];
                }),
            ];
        });
    }

    public static function getNotificationCategoryId($type): string|null
    {

        if ($type) {
            $category = NotificationCategory::where([
                'type' => $type,
                'status' => 1
            ])->first();

            return $category->id ?? null;
        }

        return $type;
    }

    public static function getNotificationTranslation($notification_category_id, $lang = 'am'): NotificCatTrans|null
    {

        return NotificCatTrans::where(['notification_category_id' => $notification_category_id, 'lang' => $lang])->first();
    }


    public static function socialMedias(){


        return [
            'facebook' => [
                    'link' => 'https://www.facebook.com/',
                    'icon' => 'facebook-f'
                ],
            'linkedin' => [
                    'link' => 'https://www.linkedin.com/in/',
                    'icon' => 'linkedin-alt'
                ],
            'telegram' => [
                    'link' => 'https://t.me/',
                    'icon' => 'telegram-alt'
                ],
            'whatsapp' => [
                'link' => 'https://wa.me/',
                'icon' => 'whatsapp'
            ],

        ];

    }
    public static function translateStatus(string $status = null): string
    {

        return match ($status) {
            'active' => __('task_status.active'),
            'in_process' => __('task_status.in_process'),
            'done' => __('task_status.done'),
            'expired' => __('task_status.expired'),
            default => ucfirst($status),
        };
    }


    public static function notificationIcons()
    {


        return [


            '1' => 'uil uil-info-circle',       //info
            '2' => 'uil uil-file-plus-alt',     //new_job
            '3' => 'uil uil-check-circle',      //job_applied
            '4' => 'uil uil-user-times',        //application_rejected
            '6' => 'uil uil-user-check',        //selected_executor
            '7' => 'uil uil-file-check',        //you_applied
            '8' => 'uil uil-stopwatch-slash',   //job_expired
            '9' => 'uil uil-clock-five',        //job_done
            '10' => 'uil uil-star'               //comment_mark

        ];

    }



}
