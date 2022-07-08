<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;


class PasswordUpdateRequest extends FormRequest
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
        $user = auth()->user();

        return [
            'old_password' => ['required', 'string','password',],
            'password' => ['required', 'string',  Rules\Password::defaults()],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // checks user current password
        // before making changes
        $validator->after(function ($validator) {
            if ( !Hash::check($this->old_password, $this->user()->password) ) {
                $validator->errors()->add('old_password', 'Your current password is incorrect.');
            }
        });
        return;
    }
}
