<?php


namespace App\Request\api\user;


use App\Request\AbstractFormRequest;

class LoginFrom extends AbstractFormRequest
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
     */
    public function rules(): array
    {
        return [
            'telephone' => ['required','integer','regex:/^1[345789][0-9]{9}$/','exists:app_user'],
            'password' => ['required','min:6','max:20'],
        ];
    }
    public function messages(): array
    {
        return [
            'telephone.required' => '电话号码必填',
            'telephone.integer' => '电话号码必须是数字',
            'password.required'  => '密码必填',
            'password.min'  => '密码字符不能小于6位',
            'password.max'  => '密码字符不能大于20位',
            'telephone.regex'  => '手机号格式不正确',
            'telephone.exists'  => '手机号不存在',
        ];
    }
}