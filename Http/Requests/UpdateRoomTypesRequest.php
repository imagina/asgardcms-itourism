<?php

namespace Modules\Itourism\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateRoomTypesRequest extends BaseFormRequest
{
    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        return [
          'title'=>'min:2',
          'description'=>'min:2',
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
