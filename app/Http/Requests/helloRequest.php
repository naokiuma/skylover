<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class helloRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'image_url' => 'required|file|image|max:10240', 
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須です。',
            'title.max:255' => 'タイトルは255文字まで入力可能です。',
            'image_url.required'  => '画像投稿は必須です。',
        ];
    }

}
