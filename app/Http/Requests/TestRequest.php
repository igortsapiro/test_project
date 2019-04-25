<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'nullable|integer',
            'string_field' => 'nullable|string',
            'boolean_field' => 'nullable|integer',
            'decimal_field' => 'nullable|numeric',
            'timestamp_field_from' => 'nullable|date',
            'timestamp_field_to' => 'nullable|date',
            'current_page' => 'nullable|integer',
            'order_by' => 'nullable|in:id,string_field,boolean_field,decimal_field,timestamp_field',
            'sort_order' => 'nullable|in:desc,asc',
        ];
    }
}
