<?php

namespace Tests\Unit\Domain\Utils;

use Challenge\Domain\Utils\WeightedAverageCalculator;
use JetBrains\PhpStorm\ArrayShape;
use Tests\BaseTest;

class WeightedAverageCalculatorTest extends BaseTest
{
    /**
     * @test
     * @dataProvider dataProviderWithCases
     */
    public function shouldWeightedAverage(
        int $stockValue,
        int $transactionTotalValue,
        int $stockQuantity,
        float $expected
    ) {
        $weightedAverageCalculator = new WeightedAverageCalculator();
        $weightedAverage = $weightedAverageCalculator->calculate(
            $stockValue,
            $transactionTotalValue,
            $stockQuantity
        );

         self::assertEquals($expected, $weightedAverage);
    }

    #[ArrayShape([
        'Case 1' => "int[]",
        'Case 2' => "int[]",
        'Case 3' => "int[]",
        'Case 4' => "int[]"
    ])]
    public function dataProviderWithCases(): array
    {
        return [
            'Case 1' => [
                'stockValue' => 0,
                'transactionTotalValue' => 1000,
                'stockQuantity' => 100,
                'expected' => 10
            ],
            'Case 2' => [
                'stockValue' => 2,
                'transactionTotalValue' => 564,
                'stockQuantity' => 10,
                'expected' => 56.6
            ],
            'Case 3' => [
                'stockValue' => 100,
                'transactionTotalValue' => 9063,
                'stockQuantity' => 200,
                'expected' => 45.81
            ],
            'Case 4' => [
                'stockValue' => 1500,
                'transactionTotalValue' => 9999,
                'stockQuantity' => 100,
                'expected' => 114.99
            ],
        ];
    }
}
