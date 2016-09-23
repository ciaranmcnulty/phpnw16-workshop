<?php

namespace spec;

use Product;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sku;

class ProductSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWithSku(Sku::fromCode('ABC123'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Product::class);
    }
}
