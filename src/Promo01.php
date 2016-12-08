<?php

namespace Example;

class Promo01 extends Promo
{
    public function accept($sn)
    {
        $type = $sn[0];
        return ($type === 'B');
    }
    public function newPrice($price)
    {
        return $price * 0.1;
    }
}