<?php

namespace Modules\Itourism\Repositories\Cache;

use Modules\Itourism\Repositories\PersonTypesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePersonTypesDecorator extends BaseCacheDecorator implements PersonTypesRepository
{
    public function __construct(PersonTypesRepository $persontypes)
    {
        parent::__construct();
        $this->entityName = 'itourism.persontypes';
        $this->repository = $persontypes;
    }
}
