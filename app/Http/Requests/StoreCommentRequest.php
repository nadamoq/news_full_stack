<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            //
        'name'    => 'required|string|min:3|max:30',
        'content' => 'required|string|max:250',
        'parent_id'=>'sometimes|numeric|exists:comments,id',
        'news_id'=>'required|numeric|exists:news,id'
        ];
    }
}
