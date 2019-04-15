<?php
namespace Modules\Itourism\Events\Handlers;

use Modules\Itourism\Events\PlanWasUpdated;
use Modules\Itourism\Repositories\PlanRepository;
use Illuminate\Support\Facades\Storage;


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
        $options=(array)$event->data['options'];
        if (!empty($event->data['mainimage'])) {
            $mainimage = saveImage($event->data['mainimage'], "assets/itourism/plan/" . $id . ".jpg");
            // if(isset($event->data['options'])){
            //     $options=(array)$event->data['options'];
            // }else{
            //     $options = array();
            // }
            $options["mainimage"] = $mainimage;
            unset($event->data['mainimage']);
        }//mainimage
        if(isset($event->data['maindocument']) && $event->data['maindocument']){
          $p=Storage::disk('publicmedia')->put("assets/itourism/plan/" . $id . ".pdf", \File::get($event->data['maindocument']));
          if($p)
            $p="assets/itourism/plan/" . $id . ".pdf";
          else
            $p=null;
          $options["document"] = $p;
          unset($event->data['maindocument']);
        }//isset maindocument
        else if(isset($event->data['oldOptions']->document))
          $options["document"] = $event->data['oldOptions']->document;
        $event->data['options'] = $options;
        $update=$this->plan->update($event->entity, $event->data);
    }

}
