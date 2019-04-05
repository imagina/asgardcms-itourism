<?php

namespace Modules\Itourism\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class PersonTypes extends Model
{
    use Translatable;

    protected $table = 'itourism__persontypes';
    public $translatedAttributes = [
      'title',
      'description'
    ];
    protected $fillable = [];
}
