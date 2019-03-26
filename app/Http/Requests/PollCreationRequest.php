<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollCreationRequest extends FormRequest
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
        if($this->isMethod('patch')){
            return [
                'question' => 'required'
            ];
        }

        return [
            'question' => 'present|required',
            'options.0' => 'present|required',
            'options.1' => 'present|required',
        ];
    }

    public function messages()
    {
        return [
            'question.required' => 'Question is rquired',
            'options.0.required' => 'Option 1 is required',
            'options.1.required' => 'Option 2 is required',
        ];
    }


}
