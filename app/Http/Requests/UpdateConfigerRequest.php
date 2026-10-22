<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigerRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp,svg', 'max:4096'],
            'logo_two' => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp,svg,ico', 'max:4096'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string'],
            'twitter' => ['nullable', 'string'],
            'youtube' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'companydetail' => ['nullable', 'string'],
            'video' => ['nullable', 'string'],
        ];
    }
}
