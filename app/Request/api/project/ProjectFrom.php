<?php

declare(strict_types=1);

namespace App\Request\api\project;

use Hyperf\Validation\Request\FormRequest;

class ProjectFrom extends FormRequest
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
            'symbol' => ['required','max:20'],
            'describe' => ['required','max:255'],
            'symbol_code' => ['required','max:255'],
            'symbol_icon' => ['required','url','max:255'],
            'contact' => ['required','max:255'],
            'contact_phone' => ['required','max:50'],
            'project_home' => ['required','url','max:255'],
            'white_paper' => ['required','url','max:255'],
            'ratio' => ['required','max:255'],
            'circulation_out' => ['required','max:255'],
            'circulation_private' => ['required','max:255'],
            'symbol_price' => ['required','min:0'],
            'online_exchange' => ['max:255'],
        ];
    }
    public function messages(): array
    {
        return [
            'symbol.required' => '英文币种名称必填',
            'symbol.max' => '英文币种名称,不能超过20个字符',
            'describe.required' => '中文币种名称必填',
            'describe.max' => '中文币种名称,不能超过255个字符',
            'symbol_code.required' => '币种代码必填',
            'symbol_code.max' => '币种代码,不能超过255个字符',
            'symbol_icon.required' => '币种图标必填',
            'symbol_icon.url' => '币种图标,必须是一个地址',
            'symbol_icon.max' => '币种图标,不能超过255个字符',
            'contact.required' => '联系人、职位，必填',
            'contact.max' => '联系人、职位,不能超过255个字符',
            'contact_phone.required' => '联系方式，必填',
            'contact_phone.max' => '联系人方式,不能超过50个字符',
            'project_home.required' => '项目官网地址必填',
            'project_home.url' => '项目官网地址,必须是一个地址',
            'project_home.max' => '项目官网地址,不能超过255个字符',
            'white_paper.required' => '白皮书地址必填',
            'white_paper.url' => '白皮书地址,必须是一个地址',
            'white_paper.max' => '白皮书地址,不能超过255个字符',
            'ratio.required' => '币种分配比列必填',
            'ratio.max' => '币种分配比列,不能超过255个字符',
            'circulation_out.required' => '币种外部流通量必填',
            'circulation_out.max' => '币种外部流通量,不能超过255个字符',
            'circulation_private.required' => '对外私募流通量必填',
            'circulation_private.max' => '对外私募流通量,不能超过255个字符',
            'symbol_price.required' => '私募公募价格必填',
            'symbol_price.min' => '私募公募价格,不能小于0',
            'online_exchange.max' => '上线的交易平台,不能超过255个字符',
        ];
    }
}
