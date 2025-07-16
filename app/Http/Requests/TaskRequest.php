<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        if(isset($this->end_date) && isset($this->start_date)){

            $arr['start_date'] = ['required', 'date', 'before_or_equal:end_date'];
            $arr['end_date'] = ['required', 'date', 'after_or_equal:start_date'];
        }

        return $arr;
    }
    // =====
}
