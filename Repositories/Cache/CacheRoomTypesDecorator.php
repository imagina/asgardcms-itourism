<?php

namespace Modules\Itourism\Repositories\Cache;

use Modules\Itourism\Repositories\RoomTypesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRoomTypesDecorator extends BaseCacheDecorator implements RoomTypesRepository
{
    public function __construct(RoomTypesRepository $roomtypes)
    {
        parent::__construct();
        $this->entityName = 'itourism.roomtypes';
        $this->repository = $roomtypes;
    }
}
