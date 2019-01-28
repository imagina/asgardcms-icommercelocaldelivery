<?php

namespace Modules\Icommercelocaldelivery\Repositories\Cache;

use Modules\Icommercelocaldelivery\Repositories\IcommerceLocalDeliveryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheIcommerceLocalDeliveryDecorator extends BaseCacheDecorator implements IcommerceLocalDeliveryRepository
{
    public function __construct(IcommerceLocalDeliveryRepository $icommercelocaldelivery)
    {
        parent::__construct();
        $this->entityName = 'icommercelocaldelivery.icommercelocaldeliveries';
        $this->repository = $icommercelocaldelivery;
    }

    /**
     * List or resources
     *
     * @return mixed
     */
    public function calculate($parameters,$conf)
    {
        return $this->remember(function () use ($parameters,$conf) {
            return $this->repository->calculate($parameters,$conf);
        });
    }

    public function percentageCart($items,$percentage,$countryFree,$countryCode)
    {
        return $this->remember(function () use ($items,$percentage,$countryFree,$countryCode) {
            return $this->repository->percentageCart($items,$percentage,$countryFree,$countryCode);
        });
    }

    public function fixedxProduct($items,$fixed,$countryFree,$countryCode)
    {
        return $this->remember(function () use ($items,$fixed,$countryFree,$countryCode) {
            return $this->repository->fixedxProduct($items,$fixed,$countryFree,$countryCode);
        });
    }
    
}
