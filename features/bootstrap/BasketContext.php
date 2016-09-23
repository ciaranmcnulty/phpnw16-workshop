<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class BasketContext implements Context
{
    /** @var Basket */
    private $basket;

    /** @var Catalogue  */
    private $catalogue;

    /** @var Product */
    private $product;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->basket = new Basket();
        $this->catalogue = new \Fake\Catalogue();
    }

    /** @Transform */
    public function createSku($sku) : Sku
    {
        return Sku::fromCode($sku);
    }

    /** @Transform */
    public function createCost($cost) : Cost
    {
        return Cost::fromPence($cost * 100);
    }

    /**
     * @Given there is a product with SKU :sku
     */
    public function thereIsAProductWithSku(Sku $sku)
    {
        $this->product = Product::withSku($sku);
    }

    /**
     * @Given this product is listed at a cost of £:cost in the catalogue
     */
    public function thisProductIsListedAtACostOfPsInTheCatalogue(Cost $cost)
    {
        $this->catalogue->listProductAtCost($this->product, $cost);
    }

    /**
     * @When I add this product to my basket from the catalogue
     */
    public function iAddTheProductWithSkuToMyBasketFromTheCatalogue()
    {
        $this->basket->addProductFromCatalogue($this->product, $this->catalogue);
    }

    /**
     * @Then the total cost of my basket should be £:cost
     */
    public function theTotalCostOfMyBasketShouldBePs(Cost $cost)
    {
        assert(
            $this->basket->totalCost()->equals($cost),
            'Cost was not expected value: ' . print_r($cost, true)
        );
    }
}
