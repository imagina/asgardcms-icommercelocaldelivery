<?php

use Modules\IcommerceLocaldelivery\Entities\Configlocaldelivery;
use Modules\IcommerceLocaldelivery\Entities\FeeTypes;

if (! function_exists('icommercelocaldelivery_get_configuration')) {

    function icommercelocaldelivery_get_configuration()
    {

    	$configuration = new Configlocaldelivery();
    	return $configuration->getData();

    }

}

/**
* Get FixedTypes
*
* @param  none
* @return Array $feetypes 
*/
if (! function_exists('icommercelocaldelivery_get_feetypes')) {

    function icommercelocaldelivery_get_feetypes()
    {
    	$feetypes = new FeeTypes();
    	return $feetypes;
    }
}


// Initial Method
if (! function_exists('icommercelocaldelivery_Init')) {

    function icommercelocaldelivery_Init($products,$options = array()){

        $items = $products["items"];
        $conf = icommercelocaldelivery_get_configuration();

        $countryFree = "";
        if (setting('icommerce::country-freeshipping')) {
            $countryFree = setting('icommerce::country-freeshipping');
        }

        $countryCode = isset($options["countryCode"]) && $options["countryCode"]!="null" ? $options["countryCode"] : null;

        if($countryCode!=null){

            if($conf->feetype=="percentage_cart")
                return icommercelocaldelivery_percentageCart($items,$conf->deliveryfee,$countryFree,$countryCode); 
            
            if($conf->feetype=="fixed_amount_product")
                return icommercelocaldelivery_fixedxProduct($items,$conf->deliveryfee,$countryFree,$countryCode);

        }else{

            return [
                'msj' => 'error',
                'data' => trans('icommercelocaldelivery::configlocaldeliveries.messages.msjini')
            ];

        }

    }

}

if (! function_exists('icommercelocaldelivery_percentageTotal')) {

    function icommercelocaldelivery_percentageCart($items,$percentage,$countryFree,$countryCode){

        $totalCar = 0;
        $total = 0;

        foreach ($items as $key => $item) {
            // Item Don't have freeshipping
            if($item->freeshipping==0){
                $totalCar = $totalCar + ($item->price * $item->quantity); 
            }else{

                // The product has freeshipping
                // and country destiny it's not the freeshipping Country
                if ($item->freeshipping == 1 && $countryCode != $countryFree) {
                    $totalCar = $totalCar + ($item->price * $item->quantity);
                }
            } 
        }

        $total = ($percentage * $totalCar ) / 100;

        $response["price"] = $total;
        $response["priceshow"] = true;

        $response["data"] = null;
        $response["msj"] = "success";

        return $response;
        
    }

}

if (! function_exists('icommercelocaldelivery_fixedxProduct')) {

    function icommercelocaldelivery_fixedxProduct($items,$fixed,$countryFree,$countryCode){

        $total = 0;

        foreach ($items as $key => $item) {
             
             // Item Don't have freeshipping
            if($item->freeshipping==0){

                $total = $total + ($fixed * $item->quantity); 

            }else{

                // The product has freeshipping
                // and country destiny it's not the freeshipping Country
                if ($item->freeshipping == 1 && $countryCode != $countryFree) {
                    $total = $total + ($fixed * $item->quantity); 
                }
            }

        }

        $response["price"] = $total;
        $response["priceshow"] = true;

        $response["data"] = null;
        $response["msj"] = "success";

        return $response;

    }
    
}