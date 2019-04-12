<?php
namespace Modules\Itourism\Events\Handlers;

use Modules\Itourism\Events\PlanWasCreated;
use Modules\Itourism\Repositories\PlanRepository;
use Modules\Itourism\Repositories\PlanPriceRepository;


class SavePlanPrices
{
    private $plan;
    private $planprice;

    public function __construct(PlanRepository $plan,PlanPriceRepository $planprice)
    {
        $this->plan = $plan;
        $this->planprice = $planprice;

    }
    public function handle(PlanWasCreated $event)
    {
        $id = $event->entity->id;
        $prices=$event->data['prices'];
        foreach($prices as $price){

          $this->planprice->create(
            [
              'plan_id'=>$id,
              'roomtype_id'=>$price->personType,
              'persontype_id'=>$price->roomType,
              'price'=>$price->price,
              'additional_night_price'=>$price->nightPrice,
            ]
          );
        }
    }

}
