<?php

namespace spec;

use Sku;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SkuSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedFromCode('ABC123');
    }

    function it_can_be_transformed_to_string()
    {
        $this->__toString()->shouldReturn('ABC123');
    }
}
