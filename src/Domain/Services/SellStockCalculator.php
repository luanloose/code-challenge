<?php

namespace Challenge\Domain\Services;

use Challenge\Domain\Entities\StockSummary;
use Challenge\Domain\Entities\Tax;
use Challenge\Domain\Entities\Transaction;

class SellStockCalculator
{
    public function calculate(Transaction $transaction, StockSummary $stockSummary): Tax
    {
        $hadLoss = $this->calculateTransactionGainsOrLosses($stockSummary, $transaction->quantity, $transaction->unitCost);
        $totalSell = $transaction->unitCost * $transaction->quantity;
        $stockSummary->subStockQuantity($transaction->quantity);

        if ($hadLoss || $totalSell <= 20000) {
            return new Tax();
        }

        $tax = $stockSummary->getEarnings() * 0.20;

        return new Tax($tax);
    }

    private function calculateTransactionGainsOrLosses(
        StockSummary $stockSummary,
        int $stockQuantity,
        float $newWeightedAverage,
    ): bool {
        $oldWeightedAverage = $stockSummary->getWeightedAverage();

        if ($oldWeightedAverage > $newWeightedAverage) {
            $loss = $this->calculateAmountOfMoney(
                $oldWeightedAverage,
                $newWeightedAverage,
                $stockQuantity
            );
            $stockSummary->setLoss($loss);
            return true;
        }
        $earnings = $this->calculateAmountOfMoney(
            $oldWeightedAverage,
            $newWeightedAverage,
            $stockQuantity
        );

        $stockSummary->setEarnings($earnings);
        return false;
    }

    private function calculateAmountOfMoney(
        float $oldWeightedAverage,
        float $newWeightedAverage,
        int $stockQuantity
    ): float {
        $total = floatval(
            bcmul(
                strval($oldWeightedAverage - $newWeightedAverage),
                strval($stockQuantity),
                2)
        );
        return abs($total);
    }
}