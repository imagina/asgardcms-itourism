<?php

namespace Modules\Itourism\Entities;

use Illuminate\Database\Eloquent\Model;

class PlanTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'title',
      'description'
    ];
    protected $table = 'itourism__plan_translations';
}
