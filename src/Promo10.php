<?php
namespace Example;

class Promo10 extends Promo
{
    public function _accept($sn)
    {
        $type = $sn[0];
        return ($type === 'C');
    }
    public function _newPrice($price)
    {
        return $price - 10;
    }
}