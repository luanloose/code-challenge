<?php

namespace Challenge\Domain\Entities;

class StockSummary
{
    public function __construct(
        private float $earnings = 0.0,
        private float $loss = 0.0,
        private float $weightedAverage = 0.0,
        private int $stockQuantity = 0,
    ) {
    }

    public function getStockValue(): float
    {
        return $this->stockQuantity * $this->weightedAverage;
    }

    public function getEarnings(): float
    {
        return $this->earnings;
    }

    public function getWeightedAverage(): float
    {
        return $this->weightedAverage;
    }

    public function setWeightedAverage(float $weightedAverage): void
    {
        $this->weightedAverage = $weightedAverage;
    }

    public function getStockQuantity(): int
    {
        return $this->stockQuantity;
    }

    public function setEarnings(float $earnings): void
    {
        $this->earnings = $earnings;
        $this->deductLosses();
    }

    public function setLoss(float $loss): void
    {
        $this->loss = $loss;
    }

    public function sumStockQuantity(int $stockQuantity): void
    {
        $this->stockQuantity += $stockQuantity;
    }

    public function subStockQuantity(int $stockQuantity): void
    {
        $this->stockQuantity -= $stockQuantity;
    }

    private function deductLosses(): void
    {
        if ($this->loss > $this->earnings){
            $this->loss -= $this->earnings;
            $this->earnings = 0;
        } else {
            $this->earnings -= $this->loss;
            $this->loss = 0;
        }
    }
}