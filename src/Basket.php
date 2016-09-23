<?php

final class Basket
{
    /** @var Cost */
    private $sumOfCosts;

    public function __construct()
    {
        $this->sumOfCosts = Cost::fromPence(0);
    }

    public function addProductFromCatalogue(Product $product, Catalogue $catalogue)
    {
        $this->sumOfCosts = $this->sumOfCosts->add($catalogue->lookupCost($product));
    }

    public function totalCost() : Cost
    {
        $vat = $this->getVat($this->sumOfCosts);
        $shipping = $this->getShipping($this->sumOfCosts);

        return $this->sumOfCosts->add($vat)->add($shipping);
    }

    private function getVat(Cost $total) : Cost
    {
        return $total->percentage(20);
    }

    private function getShipping(Cost $total) : Cost
    {
        if ($total->equals(Cost::nothing())) {
            return Cost::nothing();
        }

        if ($total->isLessThan(Cost::fromPence(1000))) {
            return Cost::fromPence(300);
        }

        return Cost::fromPence(200);
    }
}