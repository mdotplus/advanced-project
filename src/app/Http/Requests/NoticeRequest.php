<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:50'],
            'message' => ['required', 'string'],
            'recipients' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.string' => '適切なタイトルを入力してください',
            'title.max' => 'タイトルは50文字以内で入力してください',
            'message.required' => '本文を入力してください',
            'message.string' => '適切な本文を入力してください',
            'recipients.required' => '宛先を選択してください',
        ];
    }
}
