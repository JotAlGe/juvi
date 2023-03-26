<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return JWTAuth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'user_id' => ['required', 'integer'],
        ];
    }
}
