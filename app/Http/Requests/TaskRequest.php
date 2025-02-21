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
            "title"=>"required",
            "sub_category_id"=>"required",
            "location_id"=>"required",
            "description"=>"required",
            "end_date"=>'required',

        ];
        // if(isset($request->price_min) && isset($request->price_max)){

        // }

        return $arr;
    }
    // =====
}
