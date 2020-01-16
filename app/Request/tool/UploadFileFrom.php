<?php


namespace App\Request\tool;


use App\Request\AbstractFormRequest;

class UploadFileFrom extends AbstractFormRequest
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
            'file' => ['required','file','mimes:pdf','max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => '上传的必须是一个文件',
            'file.mimes' => '文件必须是PDF类型的文件',
            'file.max' => 'PDF最大2M',
            'file.file' => '文件没有上传成功',
        ];
    }
}