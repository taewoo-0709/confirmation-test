<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class ContactRequest extends FormRequest
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
            'category_id'=>['required','integer', 'exists:categories,id'],
            'first_name'=>['required','string','max:255'],
            'last_name'=>['required','string','max:255'],
            'gender'=>['required'],
            'email'=>['required','email','max:255'],
            'tel'=>['required','regex:/^\d{10,11}$/'],
            'address'=>['required','string','max:255'],
            'detail'=>['required','string','max:120'],
        ];
    }

    public function messages()
    {
        return [
            'category_id.required'=>'お問い合わせの種類を選択してください',
            'first_name.required'=>'名を入力してください',
            'last_name.required'=>'姓を入力してください',
            'gender.required'=>'性別を選択してください',
            'email.required'=>'メールアドレスを入力してください',
            'email.email'=>'メールアドレスはメール形式で入力してください',
            'tel.required'=>'電話番号を入力してください',
            'tel.regex'=>'電話番号は5桁までの数字で入力してください',
            'address.required'=>'住所を入力してください',
            'detail.required'=>'お問い合わせ内容を入力してください',
            'detail.max'=>'お問い合わせ内容は120文字以内で入力してください'
        ];
    }

    public function prepareForValidation()
    {
        if ($this->has(['tel1', 'tel2', 'tel3'])) {
            $tel = $this->input('tel1') . $this->input('tel2') . $this->input('tel3');
        $this->merge(['tel' => $tel]);
    }
}

    public function failedValidation(Validator $validator)
    {
    throw new HttpResponseException(
        redirect('/')
            ->withErrors($validator)
            ->withInput()
        );
    }
}