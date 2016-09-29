<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class WebBasketContext extends MinkContext
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var Catalogue
     */
    private $catalogue;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->catalogue = new Db\Catalogue('/tmp/mbe-workshop');
    }

    /**
     * @Given there is a product with SKU :sku
     */
    public function thereIsAProductWithSku(string $sku)
    {
        $this->product = Product::withSku(Sku::fromCode($sku));
    }

    /**
     * @Given this product is listed at a cost of £:cost in the catalogue
     */
    public function thisProductIsListedAtACostOfPsInTheCatalogue(string $cost)
    {
        $this->catalogue->listProductAtCost($this->product, Cost::fromPence((int) $cost * 100));
    }

    /**
     * @When I add this product to my basket from the catalogue
     */
    public function iAddThisProductToMyBasketFromTheCatalogue()
    {
        $this->visitPath('?sku='.$this->product);
        $this->pressButton('Add to Basket');
    }

    /**
     * @Then the total cost of my basket should be £:cost
     */
    public function theTotalCostOfMyBasketShouldBePs(string $cost)
    {
        $this->assertSession()->elementTextContains('css', '#total span', $cost);
    }
}
