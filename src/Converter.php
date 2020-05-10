<?php

namespace Rafahernandez\NumericoALetras;

class Converter
{
    public static function toString(float $amount)
    {
        return (new Number($amount))->toString();
    }
}
