<?php

namespace Tests\Unit;

use Challenge\Domain\Entities\Transaction;
use Challenge\Domain\Enums\OperationType;
use Challenge\Domain\Services\TransactionTaxesCalculator;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;

Class TransactionTaxesCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function caseOnePlusTwoTest()
    {
        # INPUT / SETUP
        $transactionsOne = [
            ["operation" =>"buy", "unit-cost" =>10.00, "quantity" => 100],
            ["operation" =>"sell", "unit-cost" =>15.00, "quantity" => 50],
            ["operation" =>"sell", "unit-cost" =>15.00, "quantity" => 50]
        ];

        $transactionsTwo = [
            ["operation" =>"buy", "unit-cost" =>10.00, "quantity" => 10000],
            ["operation" =>"sell", "unit-cost" =>20.00, "quantity" => 5000],
            ["operation" =>"sell", "unit-cost" =>5.00, "quantity" => 5000]
        ];

        $transactionsOne = $this->prepareInput($transactionsOne);
        $transactionsTwo = $this->prepareInput($transactionsTwo);

        $transactionsTaxes = new TransactionTaxesCalculator();

        # EXECUTE
        $taxesOne = $transactionsTaxes->process($transactionsOne);
        $taxesTwo = $transactionsTaxes->process($transactionsTwo);

        $this->toArrayTaxes($taxesOne);
        $this->toArrayTaxes($taxesTwo);

        # ASSERT
        self::assertEquals([["tax" => 0],["tax" => 0],["tax" => 0]], $taxesOne);
        self::assertEquals([["tax" => 0],["tax" => 10000],["tax" => 0]], $taxesTwo);
    }

    private function prepareInput(array $transactions): array
    {
         return array_map( fn (array $transaction) => new Transaction(
            operation: OperationType::from($transaction['operation']),
            unitCost: $transaction['unit-cost'],
            quantity: $transaction['quantity'],
        ), $transactions);
    }

    private function toArrayTaxes(array &$taxes)
    {
        foreach ($taxes as &$tax) {
            $tax = (array) $tax;
        }
    }

    /**
     * @test
     * @dataProvider dataProviderWithCases
     */
    public function allCasesTest(array $input, array $expected)
    {
        # INPUT / SETUP
        $transactions = $this->prepareInput($input);

        $transactionsTaxes = new TransactionTaxesCalculator();

        # EXECUTE
        $taxes = $transactionsTaxes->process($transactions);
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
                'input' => $this->loadJson('input/case1.json'),
                'expected' => $this->loadJson('output/case1.json')
            ],
            'case two' => [
                'input' => $this->loadJson('input/case2.json'),
                'expected' => $this->loadJson('output/case2.json')
            ],
            'case three' => [
                'input' => $this->loadJson('input/case3.json'),
                'expected' => $this->loadJson('output/case3.json')
            ],
            'case four' => [
                'input' => $this->loadJson('input/case4.json'),
                'expected' => $this->loadJson('output/case4.json')
            ],
            'case five' => [
                'input' => $this->loadJson('input/case5.json'),
                'expected' => $this->loadJson('output/case5.json')
            ],
            'case six' => [
                'input' => $this->loadJson('input/case6.json'),
                'expected' => $this->loadJson('output/case6.json')
            ],
            'case seven' => [
                'input' => $this->loadJson('input/case7.json'),
                'expected' => $this->loadJson('output/case7.json')
            ],
            'case eight' => [
                'input' => $this->loadJson('input/case8.json'),
                'expected' => $this->loadJson('output/case8.json')
            ],
        ];
    }

    private function loadJson(string $name): array
    {
        $file = __DIR__ . '/../../src/tests/' . $name;
        return json_decode(file_get_contents($file), true);
    }
}
