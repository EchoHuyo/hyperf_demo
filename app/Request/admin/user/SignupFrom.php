<?php

declare(strict_types=1);

namespace App\Request\admin\user;

use App\Request\AbstractFormRequest;

class SignupFrom extends AbstractFormRequest
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
            'username' => ['required','min:5','max:25','unique:user'],
            'password' => ['required','min:6','max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => '用户名必填',
            'password.required'  => '密码必填',
            'password.min'  => '密码字符不能小于6位',
            'username.min'  => '用户名不能小于5位',
            'password.max'  => '密码字符不能大于20位',
            'username.unique'  => '用户名已注册',
        ];
    }

}
