<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth('admin')->user()->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }
}
