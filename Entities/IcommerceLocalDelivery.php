<?php

namespace Modules\Icommercelocaldelivery\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class IcommerceLocalDelivery extends Model
{
    use Translatable;

    protected $table = 'icommercelocaldelivery__icommercelocaldeliveries';
    public $translatedAttributes = [];
    protected $fillable = [];
}
