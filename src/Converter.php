<?php

namespace Rafahernandez\NumericConvert;

class Converter
{
    public static function toString(float $amount)
    {
        return (new Number($amount))->toString();
    }
}
