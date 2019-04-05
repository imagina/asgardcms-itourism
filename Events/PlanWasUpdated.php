<?php

namespace Modules\Itourism\Events;

use Illuminate\Queue\SerializesModels;

class PlanWasUpdated
{
    use SerializesModels;
    public $entity;
    public  $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($entity,array $data)
    {
      $this->data=$data;
      $this->entity=$entity;
    }

}
