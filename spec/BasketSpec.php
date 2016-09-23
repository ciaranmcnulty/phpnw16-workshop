<?php

namespace spec;

use Basket;
use Catalogue;
use Cost;
use PhpSpec\ObjectBehavior;
use Product;
use Prophecy\Argument;
use Sku;

class BasketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Basket::class);
    }

    function it_costs_nothing_when_empty()
    {
        $this->totalCost()->shouldBeLike(Cost::fromPence(0));
    }

    function it_costs_high_shipping_rate_when_cost_is_high(Catalogue $catalogue)
    {
        $product = Product::withSku(Sku::fromCode('ABC123'));
        $catalogue->lookupCost($product)->willReturn(Cost::fromPence(500));

        $this->addProductFromCatalogue($product, $catalogue);

        $this->totalCost()->shouldBeLike(Cost::fromPence(900));
    }

    function it_costs_low_shipping_rate_when_cost_is_high(Catalogue $catalogue)
    {
        $product = Product::withSku(Sku::fromCode('ABC123'));
        $catalogue->lookupCost($product)->willReturn(Cost::fromPence(1000));

        $this->addProductFromCatalogue($product, $catalogue);

        $this->totalCost()->shouldBeLike(Cost::fromPence(1400));
    }
}
