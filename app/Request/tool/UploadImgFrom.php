<?php


namespace App\Request\tool;


use App\Request\AbstractFormRequest;

class UploadImgFrom extends AbstractFormRequest
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
            'file' => ['required','image','max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => '上传的必须是一个文件',
            'file.image' => '文件必须是图片（jpeg、png、bmp、gif 或者 svg)',
            'file.max' => '图片最大2m',
        ];
    }
}