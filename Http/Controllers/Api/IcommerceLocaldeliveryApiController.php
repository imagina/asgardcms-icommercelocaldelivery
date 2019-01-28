<?php

namespace Modules\Icommercelocaldelivery\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Repositories
use Modules\Icommercelocaldelivery\Repositories\IcommerceLocalDeliveryRepository;

use Modules\Icommerce\Repositories\ShippingMethodRepository;

class IcommerceLocaldeliveryApiController extends BaseApiController
{

    private $icommerceLocaldelivery;
    private $shippingMethod;
   
    public function __construct(
        IcommercelocaldeliveryRepository $icommerceLocaldelivery,
        ShippingMethodRepository $shippingMethod
    ){
        $this->icommercelocaldelivery = $icommerceLocaldelivery;
        $this->shippingMethod = $shippingMethod;
    }
    
    /**
     * Init data
     * @param Requests request
     * @param Requests array products - items (object)
     * @param Requests array products - total
     * @param Requests array options - countryCode
     * @return mixed
     */
    public function init(Request $request){

        try {

        
            // Configuration
            $shippingName = config('asgard.icommercelocaldelivery.config.shippingName');
            $attribute = array('name' => $shippingName);
            $shippingMethod = $this->shippingMethod->findByAttributes($attribute);

            $response = $this->icommercelocaldelivery->calculate($request->all(),$shippingMethod->options);
            
            
          } catch (\Exception $e) {
            //Message Error
            $status = 500;
            $response = [
              'errors' => $e->getMessage()
            ];
        }

        return response()->json($response, $status ?? 200);

    }
    
    

}