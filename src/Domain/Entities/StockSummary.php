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

    // Avaliar se faz sentido criar esses métodos
    //resetLoss
    //resetEarnings
    //setLoss
    //setEarnings
    //setWeightedAverage
    //decrementsLoss
    //decrementsEarnings
    //decrementsStockQuantity
    //incrementsStockQuantity
}