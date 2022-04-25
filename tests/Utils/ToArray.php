<?php

namespace Tests\Utils;

use Challenge\Domain\Entities\Transaction;
use Challenge\Domain\Enums\OperationType;

trait ToArray
{
    public function toArrayTaxes(array &$taxes)
    {
        foreach ($taxes as &$tax) {
            $tax = (array) $tax;
        }
    }

    public function toArrayTransaction(array $transactions): array
    {
        return array_map( fn (array $transaction) => new Transaction(
            operation: OperationType::from($transaction['operation']),
            unitCost: $transaction['unit-cost'],
            quantity: $transaction['quantity'],
        ), $transactions);
    }
}