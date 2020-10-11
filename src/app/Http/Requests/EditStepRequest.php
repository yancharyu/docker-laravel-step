<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditStepRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'integer'],
            'description' => ['required', 'string', 'max:1000'],
            'stages.*.title' => ['required', 'string', 'max:255'],
            'stages.*.summary' => ['string', 'nullable', 'max:1000'],
            'stages.*.time' => ['required', 'numeric'],
            'stages.*.time' => ['required', 'numeric', 'max:1000'],

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return array 翻訳エラーメッセージを返します
     */

    public function messages()
    {
        return [
            'string' => __('正しい文字で入力してください'),
            'category.integer' => __('半角数字で入力してください'),
            'max' => __(':max文字以内で入力してください'),
            'numeric' => __('半角数字で指定してください'),
            'stages.*.time.max' => __('1000時間以内で設定してください')
        ];
    }
}
