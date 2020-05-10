<?php


namespace Rafahernandez\NumericoALetras\Unit\Tests;
use PHPUnit\Framework\TestCase;
use Rafahernandez\NumericoALetras\Number;

class SplitMostSignificantNumberTest extends TestCase
{
    /** @test */
    public function it_handles_single_digit()
    {
        $n = new Number(8);
        $this->assertEquals(8, $n->splitMostSignificant()[0]);
        $this->assertEquals('', $n->splitMostSignificant()[1]);
    }

    /** @test */
    public function it_handles_multiple_digits()
    {
        $n = new Number(58);
        $this->assertEquals(50, $n->splitMostSignificant()[0]);
        $this->assertEquals(8, $n->splitMostSignificant()[1]);

        $this->markTestIncomplete();

        $m = new Number(123_456_789);
        $this->assertEquals(100_000_000, $m->splitMostSignificant()[0]);
        $this->assertEquals(23_456_789, $m->splitMostSignificant()[1]);
    }
}
