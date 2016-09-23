<?php

interface Catalogue
{
    public function listProductAtCost(Product $product, Cost $cost);

    public function lookupCost(Product $product) : Cost;
}
