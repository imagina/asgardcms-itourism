<?php

namespace Modules\Itourism\Entities;

use Illuminate\Database\Eloquent\Model;

class RoomTypesTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'title',
      'description'
    ];
    protected $table = 'itourism__roomtypes_translations';
}
