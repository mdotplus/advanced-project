<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'area_id' => ['required'],
            'category_id' => ['required'],
            'profile' => ['required', 'string', 'max:300'],
            'image' => ['file'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.string' => '適切な名前を入力してください',
            'name.max' => '名前は191文字以内で入力してください',
            'area_id.required' => '地域を選択してください',
            'category_id.required' => 'ジャンルを選択してください',
            'profile.required' => '店舗概要を入力してください',
            'profile.string' => '適切な形式で店舗概要を入力してください',
            'profile.max' => '店舗概要は300文字以内で入力してください',
            'image.file' => '適切な形式のファイルを選択してください',
        ];
    }
}
