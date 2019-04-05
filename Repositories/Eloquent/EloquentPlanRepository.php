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

    return $this->find($plan->id);
  }//create

}
