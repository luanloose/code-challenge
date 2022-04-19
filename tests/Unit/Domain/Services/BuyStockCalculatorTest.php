<?php

namespace Tests\Unit\Domain\Services;

use Challenge\Domain\Entities\StockSummary;
use Challenge\Domain\Entities\Transaction;
use Challenge\Domain\Enums\OperationType;
use Challenge\Domain\Services\BuyStockCalculator;
use JetBrains\PhpStorm\ArrayShape;
use Tests\BaseTest;

Class BuyStockCalculatorTest extends BaseTest
{
    /**
     * @test
     * @dataProvider dataProviderWithCases
     */
    public function shouldPassInAllCases(array $input, array $expected)
    {
        # INPUT
        $transaction = new Transaction(
            operation: OperationType::from($input['operation']),
            unitCost: $input['unit-cost'],
            quantity: $input['quantity'],
        );
        $stockSummary = new StockSummary();
        $buyStockCalculator = new BuyStockCalculator();

        # EXECUTE
        $result = $buyStockCalculator->calculate($transaction, $stockSummary);

        # ASSERT
        self::assertEquals( $expected, (array) $result);
    }


    #[ArrayShape([
        'buy stocks case one' => "array"
    ])]
    public function dataProviderWithCases(): array
    {
        return [
            'buy stocks case one' => [
                'input' => [ "operation" => "buy", "unit-cost" => 10.00, "quantity"=> 100 ],
                'expected' => ["tax" => 0]
            ]
        ];
    }
}
