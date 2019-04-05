<?php

namespace Modules\Itourism\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use Translatable;

    protected $table = 'itourism__plans';
    public $translatedAttributes = [
      'title',
      'metatitle',
      'metakeywords',
      'metadescription',
      'description'
    ];
    protected $fillable = [
      'options',
      'slug'
    ];
    protected $fakeColumns = ['options'];
    protected $casts = [
        'options' => 'array'
    ];

    public function getGalleryAttribute(){
        $images = \Storage::disk('publicmedia')->files('assets/itourism/plan/gallery/' . $this->id);
        return $images;
    }
    public function getMainImageAttribute(){
        return json_decode($this->options)->mainimage;
    }

    public function getUrlAttribute() {
        return \URL::route('itourism.plans.show', [$this->slug]);

    }

    public function roomPrice(){
      return $this->hasMany('Modules\Itourism\Entities\PlanPrice','plan_id');//Foreign key
    }
}
