<?php

declare(strict_types=1);

namespace App\Request\tool;

use App\model\user\AppUser;
use App\Request\AbstractFormRequest;

class ForgetSmsFrom extends AbstractFormRequest
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
            'telephone' => ['required','integer','regex:/^1[345789][0-9]{9}$/',function($attribute, $value, $fail){
                $userModel = AppUser::query()->where(['telephone' => $value])->first();
                if(empty($userModel)){
                    $fail('用户不存在');
                }
            }],
            'area' => ['integer','required']
        ];
    }
    public function messages(): array
    {
        return [
            'telephone.required' => '电话号码必填',
            'telephone.integer' => '电话号码必须是数字',
            'telephone.regex'  => '手机号格式不正确',
            'telephone.unique'  => '手机号已注册请去登陆',
            'area.integer'  => '地区编码必须是数字',
            'area.required'  => '地区编码必填',
        ];
    }
}
