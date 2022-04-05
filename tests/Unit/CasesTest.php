<?php

namespace Tests\Unit;

use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;

Class CasesTest extends TestCase
{
    /**
     * @test
     * @dataProvider dataProviderWithCases
     */
    public function caseTest(array $input, array $expected)
    {
        # INPUT
        var_dump($input);die;

        $transactions = array_map( fn (array $transaction) => new Transaction (
        ));

        # EXECUTE
        $result = '';

        # ASSERT
        self::assertEquals($expected, $result);
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
            'case one plus two' => [
                'input' => $this->loadJson('input/case1+2.json'),
                'expected' => $this->loadJson('output/case1+2.json')
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
        $file = __DIR__ . '/../../storage/stubs/' . $name;
        return json_decode(file_get_contents($file), true);
    }
}
