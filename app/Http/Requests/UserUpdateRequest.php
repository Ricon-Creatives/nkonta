<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'username' => ['required', 'string', 'max:191', 'unique:users,username,'.$user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone' => ['required', 'string', 'max:255'],
            'tin_no' => ['nullable', 'string', 'max:191', 'unique:users,tin_no,'.$user->id],
            'company_name' => ['required', 'string','max:255', 'unique:users,company_name,'.$user->id],
        ];
    }
}
