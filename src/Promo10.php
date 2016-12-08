<?php
namespace Example;

class Promo10 extends Promo
{
    public function accept($sn)
    {
        $type = $sn[0];
        return ($type === 'C');
    }
    public function newPrice($price)
    {
        return $price - 10;
    }
}