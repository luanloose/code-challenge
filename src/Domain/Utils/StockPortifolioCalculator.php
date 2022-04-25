<?php

namespace Challenge\Domain\Utils;

class StockPortifolioCalculator
{
    public function calculate(
        float $oldWeightedAverage,
        float $newWeightedAverage,
        int $stockQuantity
    ): float {
        return abs(
            floatval(
                bcmul(
                    strval($oldWeightedAverage - $newWeightedAverage),
                    strval($stockQuantity),
                    2
                )
            )
        );
    }
}