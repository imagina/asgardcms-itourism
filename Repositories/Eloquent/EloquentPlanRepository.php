<?php

namespace Modules\Itourism\Repositories\Eloquent;

use Modules\Itourism\Repositories\PlanRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Itourism\Events\PlanWasCreated;

class EloquentPlanRepository extends EloquentBaseRepository implements PlanRepository
{

  public function create($data)
  {
    $mainimage=$data['mainimage'];

    unset($data['mainimage']);
    $plan = $this->model->create($data);

    $data['mainimage']=$mainimage;

    event(new PlanWasCreated($plan, $data));

    return $this->model->find($plan->id);
  }//create

  public function randomOrder($exclude){
    //$exclude = group id's of plans to $exclude
    is_array($exclude) ? true : $exclude = [$exclude];
    return $this->model->whereNotIn('id',$exclude)->inRandomOrder()->get();
  }

}
