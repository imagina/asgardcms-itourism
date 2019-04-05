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
            Recibe precios nuevos.
            Recorre todos los precios registrados
              Si encuentra el planprice,actualiza el precio.
              Sino, lo encuentra fue eliminado.
          */
          $b=0;
          foreach($prices as $priceToUpdate){
            if($price->room_type_id==$priceToUpdate->roomType && $price->persontype_id==$priceToUpdate->personType){
              $price->price=$priceToUpdate->price;
              $price->update();
              $b=1;
              break;
            }//if
          }//foreach prices to update
          if($b==0)
            $price->delete();
        }//Prices registered
        //Recorre todos los precios nuevos, si consigue uno nuevo lo crea.
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
              'price'=>$priceToUpdate->price
            ]);
          }
        }//foreach prices to update
    }//handle()

}
