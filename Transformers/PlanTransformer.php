<?php

namespace Modules\Itourism\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Itourism\Transformers\PlanPriceTransformer;
class PlanTransformer extends Resource
{
  public function toArray($request)
  {
    $options=json_decode($this->options);
    if (isset($options->mainimage) && !empty($options->mainimage))
      $image = url($options->mainimage);
    else
      $image = url('modules/itourism/img/default.jpg');
    /*datos*/
    return  [
      'id' => $this->id,
      'title' => $this->title,
      'description' => $this->description,
      'slug' => $this->slug,
      'mainImage' => $image,
      'roomPrices'=>PlanPriceTransformer::collection($this->roomPrice)
    ];
  }
}
