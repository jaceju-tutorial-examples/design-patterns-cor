<?php

namespace Example;

abstract class Promo implements Calculatable
{
    /** @var Promo */
    protected $next = null;

    abstract protected function accept($sn);

    protected function newPrice($price)
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
        $this->next = $promo;
        return $this->next;
    }

    public function calculate($sn, $price)
    {
        if ($this->accept($sn)) {
            return $this->newPrice($price);
        } else {
            return $this->next->calculate($sn, $price);
        }
    }
}