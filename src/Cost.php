<?php

final class Cost
{
    /**
     * @var int
     */
    private $pence;

    private function __construct(int $pence)
    {
        $this->pence = $pence;
    }

    public static function fromPence(int $pence) : Cost
    {
        return new Cost($pence);
    }

    public static function nothing() : Cost
    {
        return Cost::fromPence(0);
    }

    public function equals(Cost $cost) : bool
    {
        return $this->pence == $cost->pence;
    }

    public function add(Cost $cost) : Cost
    {
        return new Cost($this->pence + $cost->pence);
    }

    public function percentage(int $percentage) : Cost
    {
        return new Cost((int) ($this->pence * $percentage / 100));
    }

    public function isLessThan(Cost $cost) : bool
    {
        return $this->pence < $cost->pence;
    }
}
