<?php
namespace App\Http\Services;
class productervice{
    public function calculatePrice($price, $discount=null){
        if($discount!=null)
            return $price + $price*$discount/100;
        return $price ;
    }
}