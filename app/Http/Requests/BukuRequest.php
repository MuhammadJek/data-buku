<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3',
            'jumlah' => 'required|min:1|integer',
            'price' => 'integer|required',
            'image' => 'required|file|image|mimes:jpeg,jpg,png|max:2048',
            'author' => 'required|integer|exists:users,id',
            'category_id' => 'required|integer|exists:categories,id',
            'penerbit_id' => 'required|integer|exists:penerbits,id',

        ];
    }
}
