<?php

final class Product
{
    /**
     * @var Sku
     */
    private $sku;

    private function __construct(Sku $sku)
    {
        $this->sku = $sku;
    }

    public static function withSku(Sku $sku) : Product
    {
        return new Product($sku);
    }
}
