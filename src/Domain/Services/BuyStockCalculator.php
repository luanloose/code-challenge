<?php

namespace Challenge\Domain\Services;

use Challenge\Domain\Entities\StockSummary;
use Challenge\Domain\Entities\Tax;
use Challenge\Domain\Entities\Transaction;

class BuyStockCalculator
{
    public function calculate(Transaction $transaction, StockSummary $stockSummary): Tax
    {
        $this->weightedAverageCalculator($transaction, $stockSummary);
        return new Tax();
    }

    public function weightedAverageCalculator(Transaction $transaction, StockSummary $stockSummary): void
    {
        $stockValue = $stockSummary->stockQuantity * $stockSummary->weightedAverage;
        $transactionTotalValue = $transaction->quantity * $transaction->unitCost;

        $stockSummary->stockQuantity += $transaction->quantity;

        $stockSummary->weightedAverage = floatval(
            bcdiv(
                strval($stockValue + $transactionTotalValue),
                strval($stockSummary->stockQuantity),
                2)
        );
    }
}