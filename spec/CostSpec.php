<?php

namespace spec;

use Cost;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CostSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedFromPence(500);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Cost::class);
    }

    function it_equals_similar_costs()
    {
        $this->equals(Cost::fromPence(500))->shouldReturn(true);
    }

    function it_does_not_equal_dissimilar_costs()
    {
        $this->equals(Cost::fromPence(200))->shouldReturn(false);
    }

    function it_can_be_added_to()
    {
        $this->add(Cost::fromPence(100))->shouldBeLike(Cost::fromPence(600));
    }

    function it_can_be_reduced_to_a_percentage()
    {
        $this->percentage(10)->shouldBeLike(Cost::fromPence(50));
    }

    function it_can_be_created_costing_nothing()
    {
        $this->beConstructedThroughNothing();

        $this->shouldBeLike(Cost::fromPence(0));
    }

    function it_is_less_than_a_larger_cost()
    {
        $this->shouldBeLessThan(Cost::fromPence(600));
    }

    function it_is_not_less_than_itself()
    {
        $this->shouldNotBeLessThan(Cost::fromPence(500));
    }

    function it_is_not_less_than_a_smaller_cost()
    {
        $this->shouldNotBeLessThan(Cost::fromPence(400));
    }
}
