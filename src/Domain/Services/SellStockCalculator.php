<?php

namespace Challenge\Domain\Services;

use Challenge\Domain\Entities\StockSummary;
use Challenge\Domain\Entities\Tax;
use Challenge\Domain\Entities\Transaction;

class SellStockCalculator
{
    public function calculate(Transaction $transaction, StockSummary $stockSummary): Tax
    {
        $hadLoss = $this->transactionCalculate($stockSummary, $transaction->quantity, $transaction->unitCost);
        $totalSell = $transaction->unitCost * $transaction->quantity;
        $stockSummary->stockQuantity -= $transaction->quantity;

        if ($hadLoss || $totalSell <= 20000) {
            return new Tax();
        }

        $tax = abs($stockSummary->earnings) * 0.20;

        return new Tax($tax);
    }

    private function transactionCalculate(
        StockSummary $stockSummary,
        int $stockQuantity,
        float $newWeightedAverage,
    ): bool {
        $oldWeightedAverage = $stockSummary->weightedAverage;

        if ($oldWeightedAverage > $newWeightedAverage) {
            $stockSummary->loss = $this->calculateAmountOfMoney(
                $oldWeightedAverage,
                $newWeightedAverage,
                $stockQuantity
            );
            return true;
        }

        $stockSummary->earnings = $this->calculateAmountOfMoney(
            $oldWeightedAverage,
            $newWeightedAverage,
            $stockQuantity
        );

        $this->deductLoss($stockSummary);

        return false;
    }

    private function deductLoss(StockSummary $stockSummary)
    {
        if ($stockSummary->loss > $stockSummary->earnings){
            $stockSummary->loss -= $stockSummary->earnings;
            $stockSummary->earnings = 0;
        } else {
            $stockSummary->earnings -= $stockSummary->loss;
            $stockSummary->loss = 0;
        }
    }

    private function calculateAmountOfMoney(
        float $oldWeightedAverage,
        float $newWeightedAverage,
        int $stockQuantity
    ): float {
        $total = round(($oldWeightedAverage - $newWeightedAverage) * $stockQuantity, 2);
        return abs($total);
    }
}