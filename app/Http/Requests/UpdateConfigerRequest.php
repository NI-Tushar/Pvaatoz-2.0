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
            'name' => ['string'],
            'logo' => ['mimes:png,jpg,jpeg'],
            'logo_two' => ['mimes:png,jpg,jpeg'],
            'phone' => ['numeric'],
            'email' => ['string', 'email'],
            'address' => ['string'],
            'facebook' => ['string'],
            'twitter' => ['string'],
            'youtube' => ['string'],
            'instagram' => ['string'],
            'companydetail' => ['string'],
            'video' => ['string'],
        ];
    }
}
