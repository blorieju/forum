<?php

namespace App\Http\Requests\Forum;

use App\Http\Requests\Request;

class CreateTopicFormRequest extends Request
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
            'title' => 'required|max:255',
            'body' => 'required',
            'section_id' => 'required|exists:sections,id',
        ];
    }
}
