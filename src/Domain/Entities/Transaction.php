<?php

namespace Challenge\Domain\Entities;

use Challenge\Domain\Enums\OperationType;

class Transaction
{
    public function __construct(
        public OperationType $operation,
        public float $unitCost,
        public int $quantity
    ) {

    }
}