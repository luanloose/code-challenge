<?php

namespace Challenge\Domain\Services;

use Challenge\Domain\Entities\StockSummary;
use Challenge\Domain\Entities\Tax;
use Challenge\Domain\Entities\Transaction;

class BuyStockCalculator
{
    public function calculate(Transaction $transaction, StockSummary $stockSummary): Tax
    {
        $stockValue = $stockSummary->getStockValue();
        $transactionTotalValue = $transaction->quantity * $transaction->unitCost;

        $stockSummary->sumStockQuantity($transaction->quantity);

        $stockQuantity = $stockSummary->getStockQuantity();

        $stockSummary->setWeightedAverage(
            $this->weightedAverageCalculator($stockValue, $transactionTotalValue, $stockQuantity)
        );

        return new Tax();
    }

    private function weightedAverageCalculator(
        float $stockValue,
        float $transactionTotalValue,
        float $stockQuantity
    ): float {
        return floatval( bcdiv( strval($stockValue + $transactionTotalValue), strval($stockQuantity), 2));
    }
}