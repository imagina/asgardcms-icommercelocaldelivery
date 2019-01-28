<?php

namespace Modules\Icommercelocaldelivery\Repositories\Eloquent;

use Modules\Icommercelocaldelivery\Repositories\IcommerceLocalDeliveryRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentIcommerceLocalDeliveryRepository extends EloquentBaseRepository implements IcommerceLocalDeliveryRepository
{

    function calculate($parameters,$conf){

        $items = json_decode($parameters["products"]["items"]);
        //$items = $parameters["products"]["items"];

        $countryFree = "";
        if (setting('icommerce::country-freeshipping')) {
            $countryFree = setting('icommerce::country-freeshipping');
        }

        $countryCode = isset($parameters["options"]["countryCode"]) ? $parameters["options"]["countryCode"] : null;

        if($countryCode!=null){

            if($conf->feetype=="percentage_cart")
                $total = $this->percentageCart($items,$conf->deliveryfee,$countryFree,$countryCode); 
            
            if($conf->feetype=="fixed_amount_product")
                $total = $this->fixedxProduct($items,$conf->deliveryfee,$countryFree,$countryCode);
            
            $response["status"] = "success";
            $response["items"] = null;
            $response["price"] = $total;
            $response["priceshow"] = true;

            return $response;
 
        }else{

            return [
                'status' => 'error',
                'msj' => trans('icommercelocaldelivery::icommercelocaldeliveries.messages.msjini')
            ];

        }

    }

    function percentageCart($items,$percentage,$countryFree,$countryCode){

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

        return $total;
        
    }

    function fixedxProduct($items,$fixed,$countryFree,$countryCode){

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

        return $total;

    }


}
