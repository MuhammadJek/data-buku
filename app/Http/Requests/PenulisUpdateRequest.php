<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenulisUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    protected $user;
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */


    public function rules(): array
    {
        $userId = $this->route('penuli');


        if ($this->input('password')) {
            return [
                'name' => 'required|min:3',
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('penuli'), 'uuid')],
                'password_confirm' => 'required|same:password',
            ];
        }
        return [
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('penuli'), 'uuid')],
        ];
    }
}
