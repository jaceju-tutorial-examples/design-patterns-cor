<?php

namespace Example;

abstract class Promo implements Calculatable
{
    /** @var Promo */
    protected $_next = null;

    abstract protected function _accept($sn);

    protected function _newPrice($price)
    {
        return $price;
    }

    public static function init()
    {
        $promo = new Promo08();
        $promo->setNext(new Promo01())
            ->setNext(new Promo10());
        return $promo;
    }

    public function setNext(Promo $promo)
    {
        $this->_next = $promo;
        return $this->_next;
    }

    public function calculate($sn, $price)
    {
        if ($this->_accept($sn)) {
            return $this->_newPrice($price);
        } else {
            return $this->_next->calculate($sn, $price);
        }
    }
}