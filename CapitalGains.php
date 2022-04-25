<?php

use Challenge\Domain\Entities\Transaction;
use Challenge\Domain\Enums\OperationType;
use Challenge\Domain\Services\TransactionTaxesCalculator;

require './vendor/autoload.php';

while ($line = fgets(STDIN)) {
    $transactions = array_map(fn(array $transaction) => new Transaction(
        operation: OperationType::from($transaction['operation']),
        unitCost: $transaction['unit-cost'],
        quantity: $transaction['quantity'],
    ), json_decode($line, true));

    $transactionsTaxes = new TransactionTaxesCalculator();
    $taxes = $transactionsTaxes->calculate($transactions);

    echo json_encode($taxes) . PHP_EOL;
}