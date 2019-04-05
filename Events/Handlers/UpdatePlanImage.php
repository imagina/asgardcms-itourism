<?php
namespace Modules\Itourism\Events\Handlers;

use Modules\Itourism\Events\PlanWasUpdated;
use Modules\Itourism\Repositories\PlanRepository;


class UpdatePlanImage
{
    private $plan;
    public function __construct(PlanRepository $plan)
    {
        $this->plan = $plan;
    }
    public function handle(PlanWasUpdated $event)
    {
        $id = $event->entity->id;

        if (!empty($event->data['mainimage'])) {
            $mainimage = saveImage($event->data['mainimage'], "assets/itourism/plan/" . $id . ".jpg");
            if(isset($event->data['options'])){
                $options=(array)$event->data['options'];
            }else{
                $options = array();
            }
            $options["mainimage"] = $mainimage;
            $event->data['options'] = json_encode($options);
        }else{
            $options["mainimage"] = null;
            $event->data['options'] = json_encode($options);
        }
        unset($event->data['mainimage']);
        $update=$this->plan->update($event->entity, $event->data);
    }

}
