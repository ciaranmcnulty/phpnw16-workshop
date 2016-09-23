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

    function it_is_initializable()
    {
        $this->shouldHaveType(Sku::class);
    }
}
