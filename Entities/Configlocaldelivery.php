<?php

namespace Modules\IcommerceLocaldelivery\Entities;

class Configlocaldelivery
{
   

    private $feetype;
    private $deliveryfee;
    private $status;

    public function __construct()
    {
        $this->feetype = setting('icommercelocaldelivery::feetype');
        $this->deliveryfee = setting('icommercelocaldelivery::deliveryfee');
        $this->status = setting('icommercelocaldelivery::status');
    }

    public function getData()
    {
        return (object) [
            'feetype' => $this->feetype,
            'deliveryfee' => $this->deliveryfee,
            'status' => $this->status,
        ];
    }

    /*
    public function setStatusAttribute($value)
    {
    	
    	if($value==="on"){
        	$this->attributes['status'] = 1;
    	}else{
    		$this->attributes['status'] = 0;
    	}

    }
    */
    
}
