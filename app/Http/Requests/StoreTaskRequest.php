<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\UniqueTaskName;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', new UniqueTaskName()],

            'categories' => ['required', 'array', 'min:1'],

            'categories.*' => ['integer', 'exists:categories,id']
        ];
    }
}
