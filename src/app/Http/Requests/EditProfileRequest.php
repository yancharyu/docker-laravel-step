<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'pic' => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:3072'],
            'name' => ['required', 'string', 'max:30'],
            'email' => [
                // 自分の現在登録しているメールアドレスとは重複を許容する
                'required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->whereNull('deleted_at')->ignore(Auth::id())
            ],
            'introduction' => ['string', 'nullable', 'max:1000']
        ];
    }

    public function messages()
    {
        return [
            'max' => ':max文字以内で入力してください',
            'pic.mimes' => '画像タイプはjpeg,jpg,pngのいずれかで選択してください',
            'pic.max' => '画像ファイルは:maxで選択してください'
        ];
    }
}
