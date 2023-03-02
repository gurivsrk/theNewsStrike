<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'title'=>'required|unique:blogs',
            //'title'=>'required',
            'category'=>'required',
            'content'=>'required',
            'blog_image'=>'required',
            'author'=>'required',
            'status'=>'required',
            'tags'=>'required',
        ];
    }
}
