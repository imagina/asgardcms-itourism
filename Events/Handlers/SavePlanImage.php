<?php
namespace Modules\Itourism\Events\Handlers;

use Modules\Itourism\Events\PlanWasCreated;
use Modules\Itourism\Repositories\PlanRepository;
use Illuminate\Support\Facades\Storage;

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
        $options = array();
        if (!empty($event->data['mainimage'])) {
            $mainimage = saveImage($event->data['mainimage'], "assets/itourism/plan/" . $id . ".jpg");
            if(isset($event->data['options']))
                $options=(array)$event->data['options'];
            $options["mainimage"] = $mainimage;
            unset($event->data['mainimage']);
        }//isset mainimage
        if (isset($event->data['maindocument'])) {
            if ($event->data['maindocument']) {
              $p=Storage::disk('publicmedia')->put("assets/itourism/plan/" . $id . ".pdf", \File::get($event->data['maindocument']));
              if($p)
                $p="assets/itourism/plan/" . $id . ".pdf";
              else
                $p=null;
              $options["document"] = $p;
              unset($event->data['maindocument']);
            }//if ($event->data['maindocument'])
        }//isset maindocument
        $event->data['options'] = $options;

        if (!empty($event->data['gallery']) && !empty($id)) {
            if (count(\Storage::disk('publicmedia')->files('assets/itourism/plan/gallery/' . $event->data['gallery']))) {
                \File::makeDirectory('assets/itourism/plan/gallery/' . $id);
                $success = rename('assets/itourism/plan/gallery/' . $event->data['gallery'], 'assets/itourism/plan/gallery/' . $id);
            }
        }
        //dd($event->data,$id,$event->entity);
        $this->plan->update($event->entity, $event->data);
    }

}
