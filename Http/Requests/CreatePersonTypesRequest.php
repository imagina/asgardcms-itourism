<?php

namespace Modules\Itourism\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreatePersonTypesRequest extends BaseFormRequest
{
    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        return [
            'title'=>'required|min:2',
            'description'=>'required|min:2',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
