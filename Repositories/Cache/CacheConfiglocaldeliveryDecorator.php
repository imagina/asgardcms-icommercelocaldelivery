<?php

namespace Modules\IcommerceLocaldelivery\Repositories\Cache;

use Modules\IcommerceLocaldelivery\Repositories\ConfiglocaldeliveryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheConfiglocaldeliveryDecorator extends BaseCacheDecorator implements ConfiglocaldeliveryRepository
{
    public function __construct(ConfiglocaldeliveryRepository $configlocaldelivery)
    {
        parent::__construct();
        $this->entityName = 'icommercelocaldelivery.configlocaldeliveries';
        $this->repository = $configlocaldelivery;
    }
}
