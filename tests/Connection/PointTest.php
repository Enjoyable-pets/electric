<?php

namespace App\Tests\Connection;

use App\Connection\Nand;
use App\Connection\Point;
use App\Connection\Wire;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testNandShouldBeLinkedWithWire(): void
    {
        $nand = new Nand();
        $wire = new Wire();
        $point = new Point();
        $point->mapPorts($nand->getOut(), $wire->getInA());
        $this->assertTrue($wire->isOutCurrent());

        $nand->allowInACurrent();
        $nand->allowInBCurrent();
        $this->assertFalse($wire->isOutCurrent());
    }
}