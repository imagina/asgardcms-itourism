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
      'payforms',
      'slug'
    ];
    protected $fillable = [
      'created_at',
      'options'
    ];
    protected $fakeColumns = ['options'];
    protected $casts = [
        'options' => 'array'
    ];
    //Relations

    public function roomPrice(){
      return $this->hasMany('Modules\Itourism\Entities\PlanPrice','plan_id');//Foreign key
    }

    //Attributes

    public function getOptionsAttribute($value)
    {
        return json_decode($value);
    }

    public function getGalleryAttribute(){
        $images = \Storage::disk('publicmedia')->files('assets/itourism/plan/gallery/' . $this->id);
        return $images;
    }

    public function getMainImageAttribute(){
        $options=$this->options;
        if(isset($options->mainimage)){
          return $options->mainimage;
        }
        return null;
    }//getMainImageAttribute

    public function getDocumentAttribute(){
        $options=$this->options;
        if(isset($options->document)){
          return $options->document;
        }
        return null;
    }//getDocumentAttribute

    public function getUrlAttribute() {
        return \URL::route('itourism.plans.show', [$this->slug]);
    }//getUrlAttribute

    public function getVideosAttribute(){
        if (isset($this->options->videos)&&!empty($this->options->videos)){
            $videos = explode(',',$this->options->videos);
            return $videos;
        }
        return null;
    }//getVideosAttribute()
}
