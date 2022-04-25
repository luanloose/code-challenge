<?php

namespace Tests\Unit\Domain\Services;

use Challenge\Domain\Services\TransactionTaxesCalculator;
use JetBrains\PhpStorm\ArrayShape;
use Tests\BaseTest;
use Tests\Utils\ToArray;

Class TransactionTaxesCalculatorTest extends BaseTest
{
    use ToArray;

    /**
     * @test
     * @dataProvider dataProviderWithCases
     */
    public function allCasesTest(array $transactions, array $expected)
    {
        # INPUT / SETUP
        $transactions = $this->toArrayTransaction($transactions);

        $transactionsTaxes = new TransactionTaxesCalculator();

        # EXECUTE
        $taxes = $transactionsTaxes->calculate($transactions);
        $this->toArrayTaxes($taxes);

        # ASSERT
        self::assertEquals($expected, $taxes);
    }


    #[ArrayShape([
        'case one' => "array",
        'case two' => "array",
        'case one plus two' => "array",
        'case three' => "array",
        'case four' => "array",
        'case five' => "array",
        'case six' => "array",
        'case seven' => "array",
        'case eight' => "array"
    ])]
    public function dataProviderWithCases(): array
    {
        return [
            'case one' => [
                'transactions' => [
                    ["operation" =>"buy", "unit-cost" =>10.00, "quantity" => 100],
                    ["operation" =>"sell", "unit-cost" =>15.00, "quantity" => 50],
                    ["operation" =>"sell", "unit-cost" =>15.00, "quantity" => 50]
                ],
                'expected' => [["tax" => 0],["tax" => 0],["tax" => 0]]
            ],
            'case two' => [
                'transactions' => [
                    ["operation" =>"buy", "unit-cost" =>10.00, "quantity" => 10000],
                    ["operation" =>"sell", "unit-cost" =>20.00, "quantity" => 5000],
                    ["operation" =>"sell", "unit-cost" =>5.00, "quantity" => 5000]
                ],
                'expected' => [["tax" => 0],["tax" => 10000],["tax" => 0]]
            ],
        ];
    }
}
