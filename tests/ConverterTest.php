<?php


namespace NumericConvert\NumericConvert\Tests;

use PHPUnit\Framework\TestCase;
use Rafahernandez\NumericConvert\Converter;

class ConverterTest extends TestCase
{
    /** @test */
    public function it_converts_static_amounts()
    {
        $this->assertEquals('UN', Converter::toString(1));
        $this->assertEquals('QUINCE', Converter::toString(15));
        $this->assertEquals('VEINTINUEVE', Converter::toString(29));
        $this->assertEquals('DIEZ', Converter::toString(10));
        $this->assertEquals('CINCUENTA', Converter::toString(50));
        $this->assertEquals('NOVENTA', Converter::toString(90));
        $this->assertEquals('CIEN', Converter::toString(100));
    }

    /** @test */
    public function it_converts_calculated_tens()
    {
        $this->assertEquals('TREINTA Y UN', Converter::toString(31));
        $this->assertEquals('NOVENTA Y NUEVE', Converter::toString(99));
    }

    /** @test */
    public function it_converts_calculated_hundreds()
    {
        $this->assertEquals('CIENTO UN', Converter::toString(101));
        $this->assertEquals('QUINIENTOS NUEVE', Converter::toString(509));
        $this->assertEquals('NOVECIENTOS NOVENTA Y NUEVE', Converter::toString(999));
    }

    /** @test */
    public function it_converts_calculated_thousands()
    {
        $this->assertEquals('UN MIL UN', Converter::toString(1001));
//
        $this->assertEquals('TRECE MIL NOVECIENTOS NOVENTA Y NUEVE', Converter::toString(13999));

        $this->assertEquals('CUARENTA MIL SESENTA Y CINCO', Converter::toString(40065));
        $this->assertEquals('NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE', Converter::toString(99_999));
//        $this->assertEquals('CIEN MIL', Converter::toString(100_000));
    }

    public function it_converts_calculated_hundred_thousands()
    {
        $this->markTestIncomplete();
//        $this->assertEquals('CIEN MIL', Converter::toString(100_000));
    }
}
