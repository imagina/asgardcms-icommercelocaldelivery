<?php

namespace Modules\IcommerceLocaldelivery\Entities;

/**
 * Class FeeTypes
 * @package Modules\IcommerceLocaldelivery\Entities
 */

class FeeTypes
{

    const PERCENTAGECART = "percentage_cart";
    const FIXEDAMOUNTPRODUCT = "fixed_amount_product";

    /**
     * @var array
     */

    private $ftypes = [];

    public function __construct()
    {

        $this->ftypes = [
            self::PERCENTAGECART => trans('icommercelocaldelivery::configlocaldeliveries.feetype.percentege_cart'),
            self::FIXEDAMOUNTPRODUCT => trans('icommercelocaldelivery::configlocaldeliveries.feetype.fixed_amount_product')
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */

    public function lists()
    {
        return $this->ftypes;
    }

    /**
     * Get the post status
     * @param int $statusId
     * @return string
     */

    public function get($statusId)
    {

        if (isset($this->ftypes[$statusId])) {
            return $this->ftypes[$statusId];
        }
        return $this->ftypes[self::PERCENTAGECART];

    }

}

