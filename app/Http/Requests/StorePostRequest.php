<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
       return [
            'title' =>['required', 'min:3','unique:posts,title'],
            'description' =>['required','min:10'],
            'post_creator' => ['required','exists:users,id'],
             'image' => 'required|file|mimes:jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
         return [
            'title.required' => 'A title is required',
            'description.required' => 'A description is required',
        ];
    }
}
