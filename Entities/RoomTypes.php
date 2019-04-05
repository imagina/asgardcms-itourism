<?php

namespace Modules\Itourism\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class RoomTypes extends Model
{
    use Translatable;

    protected $table = 'itourism__roomtypes';
    public $translatedAttributes = ['title','description'];
    protected $fillable = [];
}
