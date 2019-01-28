<?php

namespace Modules\Icommercelocaldelivery\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface IcommerceLocalDeliveryRepository extends BaseRepository
{

    public function calculate($parameters,$conf);

    public function percentageCart($items,$percentage,$countryFree,$countryCode);

    public function fixedxProduct($items,$fixed,$countryFree,$countryCode);

}
