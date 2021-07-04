<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'profile/edit'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
         'name' => 'required|string|max:25',
         'email'=>'string|email|max:255',
         'new_pass'=>'min:4|max:12|nullable',
         'bio'=>'max:200',
        ];
    }

    public function messages()
    {
        return [
            'required'  =>"入力必須です",
            'name.max'  => '25文字以下で入力して下さい',
            'string'    =>"文字を入力してください",
            'email'     => 'メールアドレスの形式で入力して下さい',
            'email.max' => '255文字以下で入力して下さい',
            'new_pass.min' => '4文字以上で入力して下さい',
            'new_pass.max' => '12文字以下で入力して下さい',
            'bio.max' => '200文字以下で入力して下さい',
        ];
    }
}
