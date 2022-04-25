<?php

namespace Challenge\Domain\Services;

use Challenge\Domain\Entities\StockSummary;
use Challenge\Domain\Entities\Tax;
use Challenge\Domain\Entities\Transaction;
use Challenge\Domain\Utils\WeightedAverageCalculator;

class BuyStockCalculator
{
    public function __construct(
        private WeightedAverageCalculator $weightedAverageCalculator = new WeightedAverageCalculator()
    ) {
    }

    public function calculate(Transaction $transaction, StockSummary $stockSummary): Tax
    {
        $stockValue = $stockSummary->getStockValue();
        $transactionTotalValue = $transaction->quantity * $transaction->unitCost;

        $stockSummary->sumStockQuantity($transaction->quantity);

        $stockQuantity = $stockSummary->getStockQuantity();

        $weightedAverage = $this->weightedAverageCalculator->calculate(
            $stockValue,
            $transactionTotalValue,
            $stockQuantity
        );

        $stockSummary->setWeightedAverage($weightedAverage);

        return new Tax();
    }
}