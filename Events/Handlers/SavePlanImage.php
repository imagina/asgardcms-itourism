<?php
namespace Modules\Itourism\Events\Handlers;

use Modules\Itourism\Events\PlanWasCreated;
use Modules\Itourism\Repositories\PlanRepository;


class SavePlanImage
{
    private $plan;
    public function __construct(PlanRepository $plan)
    {
        $this->plan = $plan;
    }
    public function handle(PlanWasCreated $event)
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

        if (!empty($event->data['gallery']) && !empty($id)) {
            if (count(\Storage::disk('publicmedia')->files('assets/itourism/plan/gallery/' . $event->data['gallery']))) {
                \File::makeDirectory('assets/itourism/plan/gallery/' . $id);
                $success = rename('assets/itourism/plan/gallery/' . $event->data['gallery'], 'assets/itourism/plan/gallery/' . $id);
            }
        }

        $this->plan->update($event->entity, $event->data);
    }

}
