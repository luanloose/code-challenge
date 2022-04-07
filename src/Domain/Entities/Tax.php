<?php

namespace Challenge\Domain\Entities;

class Tax
{
    public function __construct(
        public int $tax = 0
    ) {
    }
}