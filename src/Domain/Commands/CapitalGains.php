<?php

use Challenge\Domain\Entities\Transaction;
use Challenge\Domain\Enums\OperationType;
use Challenge\Domain\Services\TransactionTaxesCalculator;

require './vendor/autoload.php';

echo "\033[0;32mInforme o JSON de entrada: \033[0m" . PHP_EOL;

$transactions = array_map( fn (array $transaction) => new Transaction(
    operation: OperationType::from($transaction['operation']),
    unitCost: $transaction['unit-cost'],
    quantity: $transaction['quantity'],
), json_decode(trim(fgets(STDIN)), true));

$transactionsTaxes = new TransactionTaxesCalculator();
$taxes = $transactionsTaxes->process($transactions);

echo PHP_EOL . "\033[0;32mSaida: \033[0m" . PHP_EOL;
echo json_encode($taxes) . PHP_EOL;