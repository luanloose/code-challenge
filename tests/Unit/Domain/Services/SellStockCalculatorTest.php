<?php

namespace Tests\Unit\Domain\Services;

use Challenge\Domain\Entities\StockSummary;
use Challenge\Domain\Entities\Transaction;
use Challenge\Domain\Enums\OperationType;
use Challenge\Domain\Services\SellStockCalculator;
use JetBrains\PhpStorm\ArrayShape;
use Tests\BaseTest;

Class SellStockCalculatorTest extends BaseTest
{
    /**
     * @test
     * @dataProvider dataProviderWithCases
     */
    public function shouldPassInAllCases(array $input, array $stockSummary, array $expected)
    {
        # INPUT
        $transaction = new Transaction(
            operation: OperationType::from($input['operation']),
            unitCost: $input['unit-cost'],
            quantity: $input['quantity'],
        );
        $stockSummary = new StockSummary(...$stockSummary);
        $sellStockCalculator = new SellStockCalculator();

        # EXECUTE
        $result = $sellStockCalculator->calculate($transaction, $stockSummary);

        # ASSERT
        self::assertEquals($expected, (array) $result);
    }

    #[ArrayShape([
        'sell stocks without taxes' => "array",
        'sell stocks with loss' => "array",
        'sell stocks with gains' => "array"
    ])]
    public function dataProviderWithCases(): array
    {
        return [
            'sell stocks without taxes' => [
                'input' => [ "operation" => "sell", "unit-cost" => 15.00, "quantity"=> 50 ],
                'stockSummary' => [
                    "earnings" => 0.0,
                    "loss" => 0.0,
                    "weightedAverage" => 15.00,
                    "stockQuantity" => 100
                ],
                'expected' => ["tax" => 0]
            ],
            'sell stocks with loss' => [
                'input' => [ "operation" => "sell", "unit-cost" => 5.00, "quantity"=> 5000 ],
                'stockSummary' => [
                    "earnings" => 0.0,
                    "loss" => 0.0,
                    "weightedAverage" => 10.00,
                    "stockQuantity" => 10000
                ],
                'expected' => ["tax" => 0]
            ],
            'sell stocks with gains' => [
                'input' => [ "operation" => "sell", "unit-cost" => 20.00, "quantity"=> 3000 ],
                'stockSummary' => [
                    "earnings" => 0.0,
                    "loss" => 25000,
                    "weightedAverage" => 10.00,
                    "stockQuantity" => 10000
                ],
                'expected' => ["tax" => 1000]
            ]
        ];
    }
}
