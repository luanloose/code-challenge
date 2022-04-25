<?php

namespace Tests\Unit\Domain\Utils;

use Challenge\Domain\Utils\StockPortifolioCalculator;
use JetBrains\PhpStorm\ArrayShape;
use Tests\BaseTest;

class StockPortifolioCalculatorTest extends BaseTest
{
    /**
     * @test
     * @dataProvider dataProviderWithCases
     */
    public function shouldCalculateStockPortifolio(
        $oldWeightedAverage,
        $newWeightedAverage,
        $stockQuantity,
        $expected
    ) {

        $stockPortifolioCalculator = new StockPortifolioCalculator();
        $stockPortifolio = $stockPortifolioCalculator->calculate(
            $oldWeightedAverage,
            $newWeightedAverage,
            $stockQuantity
        );

        self::assertEquals($expected, $stockPortifolio);
    }

    #[ArrayShape([
        'Stock Portifolio zero' => "array",
        'Stock Portifolio with gains' => "int[]",
        'Stock Portifolio with losses' => "int[]"
    ])]
    public function dataProviderWithCases(): array
    {
        return [
            'Stock Portifolio zero' => [
                'oldWeightedAverage' => 10,
                'newWeightedAverage' => 10,
                'stockQuantity' => 2,
                'expected' => 0.0
            ],
            'Stock Portifolio with gains' => [
                'oldWeightedAverage' => 10,
                'newWeightedAverage' => 20,
                'stockQuantity' => 100,
                'expected' => 1000
            ],
            'Stock Portifolio with losses' => [
                'oldWeightedAverage' => 10,
                'newWeightedAverage' => 5,
                'stockQuantity' => 100,
                'expected' => 500
            ],
        ];
    }
}
