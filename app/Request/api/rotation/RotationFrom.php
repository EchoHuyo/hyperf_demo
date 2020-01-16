<?php


namespace App\Request\api\rotation;


use App\Request\AbstractFormRequest;

class RotationFrom extends AbstractFormRequest
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
            'lang' => ['required'],
        ];
    }
    public function messages(): array
    {
        return [
            'lang.required' => '语言必填',
        ];
    }
}