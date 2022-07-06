<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => ['nullable','date'],
            'amount' => ['required',],
            'account' => ['required','integer'],
            'category' => ['required','integer'],
            'description_to_credit' => ['required'],
            'description_to_debit' => ['required'],
            'type' => ['required'],
            'slug' => ['nullable','string'],
        ];

    }
}
