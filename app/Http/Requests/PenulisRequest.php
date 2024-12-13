<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenulisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    private $user;
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

        $this->user = User::all();
        return [
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ];
    }
}
