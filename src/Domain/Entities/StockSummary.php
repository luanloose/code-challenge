<?php

namespace Challenge\Domain\Entities;

class StockSummary
{
    public function __construct(
        public float $earnings = 0.0,
        public float $loss = 0.0,
        public float $weightedAverage = 0.0,
        public int $stockQuantity = 0,
    ) {
    }
}