<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            'opening_stock'=>'required|min:0',
            'current_stock'=>'required|min:0',
            'closing_stock'=>'required|min:0',
            'packaged_qty'=>'required|min:0',
            'restocked_qty'=>'required|min:0',
        ];
    }
}
