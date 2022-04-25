<?php

namespace Challenge\Domain\Utils;

class WeightedAverageCalculator
{
    public function calculate( float $stockValue, float $transactionTotalValue, float $stockQuantity): float
    {
        return floatval( bcdiv( strval($stockValue + $transactionTotalValue), strval($stockQuantity), 2));
    }
}