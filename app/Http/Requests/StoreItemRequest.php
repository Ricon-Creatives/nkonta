<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'item_name' => ['required'],
            'qty' => ['required',],
            'price' => ['required'],
            'acc_dr' => ['required','string'],
            'acc_cr' => ['required','string'],
            'discount' => ['nullable','integer'],
        ];
    }
}
