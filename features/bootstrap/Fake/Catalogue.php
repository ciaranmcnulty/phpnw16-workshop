<?php

namespace Fake;

use Cost;
use Product;

class Catalogue implements \Catalogue
{
    private $costs;

    public function __construct()
    {
        $this->costs = new \SplObjectStorage();
    }

    function listProductAtCost(Product $product, Cost $cost)
    {
        $this->costs[$product] = $cost;
    }

    public function lookupCost(Product $product) : Cost
    {
        return $this->costs[$product];
    }
}