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
      'description',
      'notes',
      'includes',
      'notincludes',
      'payforms'
    ];
    protected $fillable = [
      'created_at',
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
    public function getDocumentAttribute(){
        $options=json_decode($this->options);
        if(isset($options->document)){
          return json_decode($this->options)->document;
        }
        return null;
    }

    public function getUrlAttribute() {
        return \URL::route('itourism.plans.show', [$this->slug]);

    }

    public function roomPrice(){
      return $this->hasMany('Modules\Itourism\Entities\PlanPrice','plan_id');//Foreign key
    }

    public function getVideosAttribute(){

        if (isset(json_decode($this->options)->videos)&&!empty(json_decode($this->options)->videos)){

            $videos = explode(',',json_decode($this->options)->videos);

            return $videos;
        }
        return null;
    }
}
