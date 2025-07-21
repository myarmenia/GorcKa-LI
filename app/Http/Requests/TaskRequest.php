<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $arr= [
            "title" => "required",
            "category_id" => "required",
            "sub_category_id" => "required",
            "location_id" => "required",
            // "price_max" => "required",
            // "end_date" => 'required',
        ];

        // if(isset($this->price_min) && isset($this->price_max)){

        //         $arr['price_min'] = ['required', 'numeric', 'lte:price_max'];
        //         $arr['price_max'] = ['required', 'numeric', 'gte:price_min'];
        // }
        if (isset($this->start_date)){
            $arr['start_date'] = ['required', 'date', 'after_or_equal:today'];
        }
        if (isset($this->end_date) && !isset($this->start_date)){
            $arr['end_date'] = ['required', 'date', 'after:today'];
        }
        if(isset($this->end_date) && isset($this->start_date)){


             $arr['start_date'] = ['required', 'date', 'after_or_equal:today', 'before_or_equal:end_date'];
             $arr['end_date'] = ['required', 'date', 'after:start_date'];
        }

        return $arr;
    }
        public function messages()
        {
            $locale = App::getLocale();
    $hasStart = isset($this->start_date);
    $hasEnd = isset($this->end_date);

            $endAfterMessage = match ($locale) {
                'ru' => $hasStart && $hasEnd
                    ? 'Дата окончания должна быть позже даты начала.'
                    : 'дата окончания должна быть после сегодняшнего дня',
                'am' => $hasStart && $hasEnd
                    ? 'Ավարտի ամսաթիվը պետք է լինի մեկնարկի ամսաթվից հետո։'
                    : 'ավարտի ամսաթիվը պետք է լինի այսօրվան հաջորդող ամսաթիվ',
                'en' => $hasStart && $hasEnd
                    ? 'End date must be after start date.'
                    : 'End date must be a date after today',
                default => $hasStart && $hasEnd
                    ? 'End date must be after start date.'
                    : 'End date must be a date after today',
            };

            return [
                'start_date.after_or_equal' => match ($locale) {
                    'ru' => 'Дата начала должна быть сегодня или более поздняя дата.',
                    'am' => 'Մեկնարկի ամսաթիվը պետք է լինի այսօրվա կամ հաջորդող ամսաթիվ',
                    'en' => 'Start date must be today or a future date',
                    default => 'Start date must be today or a future date',
                },
                'end_date.after' => $endAfterMessage,
            ];
        }
    // =====
}
