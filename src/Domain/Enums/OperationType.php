<?php

namespace Challenge\Domain\Enums;

enum OperationType: string
{
    case Buy = 'buy';
    case Sell = 'sell';
}