<?php

final class Sku
{
    /**
     * @var string
     */
    private $code;

    private function __construct(string $code)
    {
        $this->code = $code;
    }

    public static function fromCode(string $code) : Sku
    {
        return new Sku($code);
    }
}
