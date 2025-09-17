<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class storeNewsRequest extends FormRequest
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
            'title'=>'required|string|min:10',
            'description'=>'string|required|max:200', 
            'content'=>'required|string',
            'category_id'=>'required|exists:categories,id',
            
            'images'=>'required|array',
            'images.*'=>'max:4096|image|mimes:png,jpg'
        ];
     
    }
}
