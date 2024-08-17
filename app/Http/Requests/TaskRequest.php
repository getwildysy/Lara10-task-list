<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //預設false 改為true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        //原本$request是object(實例、instance，代表了整個 HTTP 請求。
        // 它包含了所有的請求數據、標頭、檔案、路由參數等)，驗證完後會變成array
        // ，array的key是驗證規則中指定的字段名，值則是對應的已驗證數據
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'long_description' => 'nullable',
        ];
    }
}
