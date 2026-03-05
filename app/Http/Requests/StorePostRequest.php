<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'description'  => ['nullable', 'string', 'max:2000'],
            'craft_type'   => ['required', 'in:crochet,knitting,embroidery'],
            'tags'         => ['nullable', 'string', 'max:500'],
            'images'       => ['required', 'array', 'min:1', 'max:10'],
            'images.*'     => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.required'  => 'At least one image is required.',
            'images.max'       => 'You can upload a maximum of 10 images.',
            'images.*.image'   => 'Each file must be an image.',
            'images.*.max'     => 'Each image must not exceed 5MB.',
            'craft_type.in'    => 'Craft type must be crochet, knitting, or embroidery.',
        ];
    }
}
