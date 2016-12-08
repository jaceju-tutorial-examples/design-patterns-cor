<?php

namespace Example;

class PromoByClosure implements Calculatable
{
    public function calculate($sn, $price)
    {
        return $this->resolve([
            $this->promo08($sn, $price),
            $this->promo01($sn, $price),
            $this->promo10($sn, $price),
        ]);
    }

    /**
     * @param array $resolvers
     * @return bool|mixed
     */
    private function resolve(array $resolvers)
    {
        /** @var \Closure $resolver */
        $result = null;
        foreach (array_reverse($resolvers) as $resolver) {
            $result = $resolver($result);
        }
        return $result;
    }

    /**
     * @param $sn
     * @param $price
     * @return \Closure
     */
    private function promo08($sn, $price)
    {
        return function ($next) use ($sn, $price) {
            if ('A' === $sn[0]) {
                return $price * 0.8;
            }
            return $next;
        };
    }

    /**
     * @param $sn
     * @param $price
     * @return \Closure
     * @internal param Closure $next
     */
    private function promo01($sn, $price)
    {
        return function ($next) use ($sn, $price) {
            if ('B' === $sn[0]) {
                return $price * 0.1;
            }
            return $next;
        };
    }

    /**
     * @param $sn
     * @param $price
     * @return \Closure
     */
    private function promo10($sn, $price)
    {
        return function ($next) use ($sn, $price) {
            if ('C' === $sn[0]) {
                return $price - 10;
            }
            return $next;
        };
    }
}