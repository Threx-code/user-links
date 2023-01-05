<?php

namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = request()->input('user_id');
        return [
            'username' => ['nullable', 'string', Rule::unique('users', 'username')->ignore($userId)],
            'phone_number' => ['nullable', Rule::unique('users', 'phone_number')->ignore($userId)]
        ];
    }
}
