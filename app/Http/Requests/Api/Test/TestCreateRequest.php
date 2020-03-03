<?php

namespace App\Http\Requests\Api\Test;

use Illuminate\Foundation\Http\FormRequest;

class TestCreateRequest extends FormRequest
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
        return [
            'title' => 'required|string|between:5,255',
            'about' => 'required|string',
            'timer' => 'nullable|numeric|between:10,180',
            'full_result' => 'required|boolean',

            'tags' => 'required|array',
            'tags.*' => 'required|string|between:3,15',

            'questions' => 'required|array|between:2,100',
            'questions.*.body' => 'required|string',
            'questions.*.points' => 'required|numeric|between:1,10',
            'questions.*.answers' => 'required|array',
        ];
    }
}
