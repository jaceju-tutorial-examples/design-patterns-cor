<?php

namespace Example;

class Promo08 extends Promo
{
    public function accept($sn)
    {
        $type = $sn[0];
        return ($type === 'A');
    }
    public function newPrice($price)
    {
        return $price * 0.8;
    }
}