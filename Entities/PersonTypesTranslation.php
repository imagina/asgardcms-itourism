<?php

namespace Modules\Itourism\Entities;

use Illuminate\Database\Eloquent\Model;

class PersonTypesTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'title',
      'description'
    ];
    protected $table = 'itourism__persontypes_translations';
}
