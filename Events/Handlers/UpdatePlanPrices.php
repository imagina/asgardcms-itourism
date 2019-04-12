<?php
namespace Modules\Itourism\Events\Handlers;

use Modules\Itourism\Events\PlanWasUpdated;
use Modules\Itourism\Repositories\PlanRepository;
use Modules\Itourism\Entities\PlanPrice;


class UpdatePlanPrices
{

    public function __construct()
    {

    }
    public function handle(PlanWasUpdated $event)
    {
        $id = $event->entity->id;
        $prices=json_decode(json_encode($event->data['prices']));
        $pricesPlan=PlanPrice::where('plan_id',$id)->get();
        $newPlans=[];
        foreach($pricesPlan as $price){
          /*
          Receive new prices
                      Scroll through all registered prices
                        If you find the planprice, update the price.
                        But, find it was eliminated.
          */
          $b=0;
          foreach($prices as $priceToUpdate){
            if($price->room_type_id==$priceToUpdate->roomType && $price->persontype_id==$priceToUpdate->personType){
              $price->price=$priceToUpdate->price;
              $price->additional_night_price=$priceToUpdate->nightPrice;
              $price->update();
              $b=1;
              break;
            }//if
          }//foreach prices to update
          if($b==0)
            $price->delete();
        }//Prices registered
        //Go through all the new prices, if you get a new one, create it.
        foreach($prices as $priceToUpdate){
          $b=0;
          foreach($pricesPlan as $price){
            if($price->room_type_id==$priceToUpdate->roomType && $price->persontype_id==$priceToUpdate->personType){
              $b=1;
              break;
            }//if
          }
          if($b==0){
            PlanPrice::create([
              'plan_id'=>$id,
              'roomtype_id'=>$priceToUpdate->roomType,
              'persontype_id'=>$priceToUpdate->personType,
              'price'=>$priceToUpdate->price,
              'additional_night_price'=>$priceToUpdate->nightPrice,

            ]);
          }
        }//foreach prices to update
    }//handle()

}
