<?php

namespace Modules\Itourism\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class PlanPriceTransformer extends Resource
{
  public function toArray($request)
  {
    /*datos*/
    return  [
      'id' => $this->id,
      'roomType' => $this->roomType->title,
      'personType' => $this->personType->title,
      'plan' => $this->plan->title,
      'price' => $this->price,
    ];
  }
}
