<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // Pastikan user login dulu
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072', // Max 3MB
            'category' => 'required|in:funny,dark,wholesome,savage',
        ];
    }
}
