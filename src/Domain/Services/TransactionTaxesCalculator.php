<?php

namespace Challenge\Domain\Services;

use Challenge\Domain\Entities\Tax;
use Challenge\Domain\Entities\Transaction;
use Challenge\Domain\Enums\OperationType;
use Challenge\Domain\Entities\StockSummary;

class TransactionTaxesCalculator
{
    public function __construct(
        private BuyStockCalculator $buyStockCalculator = new BuyStockCalculator(),
        private SellStockCalculator $sellStockCalculator = new SellStockCalculator()
    ) {
    }

    public function calculate(array $transactions): array
    {
        $stockSummary = new StockSummary();
        $taxes = [];
        foreach ($transactions as $transaction) {
            $taxes[] = $this->calculateTaxes($transaction, $stockSummary);
        }

        return $taxes;
    }

    private function calculateTaxes(Transaction $transaction, StockSummary $stockSummary): Tax
    {
        return match ($transaction->operation) {
            OperationType::Buy => $this->buyStockCalculator->calculate($transaction, $stockSummary),
            OperationType::Sell => $this->sellStockCalculator->calculate($transaction, $stockSummary),
        };
    }
}