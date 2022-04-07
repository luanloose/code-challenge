<?php

use Challenge\Domain\Entities\Transaction;
use Challenge\Domain\Enums\OperationType;
use Challenge\Domain\Services\TransactionTaxesCalculator;

require './vendor/autoload.php';

echo "Informe o JSON de entrada:" . PHP_EOL;

$transactions = array_map( fn (array $transaction) => new Transaction(
    operation: OperationType::from($transaction['operation']),
    unitCost: $transaction['unit-cost'],
    quantity: $transaction['quantity'],
), json_decode(trim(fgets(STDIN)), true));

$transactionsTaxes = new TransactionTaxesCalculator();

$taxes = $transactionsTaxes->process($transactions);

// Output
echo PHP_EOL;
echo "Saida:" . PHP_EOL;
echo json_encode($taxes) . PHP_EOL;