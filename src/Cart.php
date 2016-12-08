<?php
namespace Example;

class Cart
{
    protected static $_priceTable = [
        'A0001' => 100,
        'A0002' => 150,
        'B0001' => 300,
        'B0002' => 200,
        'C0001' => 200,
        'C0002' => 200,
    ];
    protected $_total = 0;
    protected $_items = [];

    /** @var Promo */
    protected $_promo;

    public function setPromo(Calculatable $promo)
    {
        $this->_promo = $promo;
    }

    public function add($sn, $quantity)
    {
        $price = static::$_priceTable[$sn];
        $price = $this->_promo->calculate($sn, $price);
        $this->_items[$sn] = [$price, $quantity];
    }

    public function calculate()
    {
        // A * 0.8, B * 0.1, C - 10
        foreach ($this->_items as $sn => $info) {
            list($price, $quantity) = $info;
            $this->_total += $price * $quantity;
        }
    }

    public function listAll()
    {
        $result = [];
        foreach ($this->_items as $sn => $info) {
            list($price, $quantity) = $info;
            $result[] = $sn . ' (' . $price . ') x ' . $quantity;
        }
        return $result;
    }

    public function getTotal()
    {
        return $this->_total;
    }
}



