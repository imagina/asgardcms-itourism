<?php

namespace Modules\Itourism\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdatePlanPriceRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'price'=>'numeric|between:0.01,9999999999999999999999999999.99'

        ];
    }

    public function translationRules()
    {
        return [];
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
