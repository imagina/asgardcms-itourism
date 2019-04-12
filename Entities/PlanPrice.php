<?php

namespace Modules\Itourism\Entities;

use Illuminate\Database\Eloquent\Model;

class PlanPrice extends Model
{

    protected $table = 'itourism__planprices';
    protected $fillable = [
      'plan_id',
      'roomtype_id',
      'persontype_id',
      'price',
      'additional_night_price'
    ];

    public function roomType(){
      return $this->belongsTo('Modules\Itourism\Entities\RoomTypes','roomtype_id');
    }
    public function personType(){
      return $this->belongsTo('Modules\Itourism\Entities\PersonTypes','persontype_id');
    }
    public function plan(){
      return $this->belongsTo('Modules\Itourism\Entities\Plan','plan_id');
    }
}
