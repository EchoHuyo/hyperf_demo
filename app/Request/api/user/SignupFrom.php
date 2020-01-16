<?php

declare(strict_types=1);

namespace App\Request\api\user;

use App\Request\AbstractFormRequest;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\ContainerInterface;
use Hyperf\Contract\SessionInterface;
use Hyperf\Di\Annotation\Inject;
use Lizhaoyang\Captcha\Captcha;

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
     * @Inject()
     * @var ContainerInterface
     */
    protected $container;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'telephone' => ['required','integer','regex:/^1[345789][0-9]{9}$/','unique:app_user'],
            'password' => ['required','min:6','max:20'],
            'area' => ['required','integer'],
            'captcha' => ['required'],
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
            'area.integer'  => '地区编码必须是数字',
            'area.required'  => '地区编码必填',
            'telephone.regex'  => '手机号格式不正确',
            'telephone.unique'  => '手机号已注册请去登陆',
            'captcha.required'  => '验证码必填',
        ];
    }

}
