<?php

use Example\Cart;
use Example\Promo;
use Example\PromoByClosure;

class CartTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_get_total_by_promo()
    {
        $promo = Promo::init();
        $cart = new Cart();
        $cart->setPromo($promo);
        $cart->add('A0001', 1);
        $cart->add('A0002', 2);
        $cart->add('B0001', 1);
        $cart->add('B0002', 2);
        $cart->add('C0001', 1);
        $cart->add('C0002', 2);
        $cart->calculate();
        $total = $cart->getTotal();
        $this->assertEquals(960, $total);
    }

    /**
     * @test
     */
    public function it_should_get_total_by_closure()
    {
        $promo = new PromoByClosure();
        $cart = new Cart();
        $cart->setPromo($promo);
        $cart->add('A0001', 1);
        $cart->add('A0002', 2);
        $cart->add('B0001', 1);
        $cart->add('B0002', 2);
        $cart->add('C0001', 1);
        $cart->add('C0002', 2);
        $cart->calculate();
        $total = $cart->getTotal();
        $this->assertEquals(960, $total);
    }
}
