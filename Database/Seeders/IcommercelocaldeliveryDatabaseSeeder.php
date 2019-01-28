<?php

namespace Modules\Icommercelocaldelivery\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Icommerce\Entities\ShippingMethod;

class IcommercelocaldeliveryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $options['init'] = "Modules\Icommercelocaldelivery\Http\Controllers\Api\IcommerceLocaldeliveryApiController";
        $options['feetype'] = "percentage_cart";
        $options['deliveryfee'] = 0;

        $params = array(
            'title' => trans('icommercelocaldelivery::icommercelocaldeliveries.single'),
            'description' => trans('icommercelocaldelivery::icommercelocaldeliveries.description'),
            'name' => config('asgard.icommercelocaldelivery.config.shippingName'),
            'status' => 0,
            'options' => $options
        );

        ShippingMethod::create($params);

    }
}
