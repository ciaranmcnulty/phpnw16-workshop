<?php

namespace Db;

use Catalogue as CatalogueInterface;
use Cost;
use Product;

class Catalogue implements CatalogueInterface
{
    private $cost;
    private $path;

    public function __construct(string $path)
    {
        if (file_exists($path)) {
            $this->cost = unserialize(file_get_contents($path));
        }
        $this->path = $path;
    }

    public function listProductAtCost(Product $product, Cost $cost)
    {
        $this->cost = $cost;
        file_put_contents($this->path, serialize($this->cost));
    }

    public function lookupCost(Product $product) : Cost
    {
        return $this->cost;
    }
}