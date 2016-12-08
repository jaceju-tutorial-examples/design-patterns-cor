<?php

namespace Example;

class Promo08 extends Promo
{
    public function _accept($sn)
    {
        $type = $sn[0];
        return ($type === 'A');
    }
    public function _newPrice($price)
    {
        return $price * 0.8;
    }
}