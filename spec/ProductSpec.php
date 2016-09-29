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

    function it_can_be_transformed_to_string()
    {
        $this->__toString()->shouldReturn('ABC123');
    }
}
