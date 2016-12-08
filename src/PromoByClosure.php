<?php

namespace Example;

class PromoByClosure implements Calculatable
{
    public function calculate($sn, $price)
    {
        $resolver = $this->getResolver([
            $this->promo08(),
            $this->promo01(),
            $this->promo10(),
        ]);
        return $resolver($sn, $price);
    }

    /**
     * @param array $resolvers
     * @return \Closure
     */
    private function getResolver(array $resolvers)
    {
        $defaultResolver = array_pop($resolvers);
        $resolver = array_reduce(array_reverse($resolvers), function ($next, $resolver) {
            return $resolver($next);
        }, $defaultResolver());
        return $resolver;
    }

    /**
     * @return \Closure
     */
    private function promo08()
    {
        return function (\Closure $next) {
            return function ($sn, $price) use ($next) {
                if ('A' === $sn[0]) {
                    return $price * 0.8;
                }
                return $next($sn, $price);
            };
        };
    }

    /**
     * @return \Closure
     */
    private function promo01()
    {
        return function (\Closure $next) {
            return function ($sn, $price) use ($next) {
                if ('B' === $sn[0]) {
                    return $price * 0.1;
                }
                return $next($sn, $price);
            };
        };
    }

    /**
     * @return \Closure
     */
    private function promo10()
    {
        return function () {
            return function ($sn, $price) {
                if ('C' === $sn[0]) {
                    return $price - 10;
                }
                return $price;
            };
        };
    }
}