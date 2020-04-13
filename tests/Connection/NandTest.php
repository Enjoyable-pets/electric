<?php

namespace App\Tests\Connection;

use App\Connection\Nand;
use PHPUnit\Framework\TestCase;

class NandTest extends TestCase
{
    public function testNandShouldUpdateOutput(): void
    {
        $nand = new Nand();
        $nand->allowInACurrent();
        $this->assertTrue($nand->isOutCurrent());
        $nand->allowInBCurrent();
        $this->assertFalse($nand->isOutCurrent());
        $nand->stopInACurrent();
        $this->assertTrue($nand->isOutCurrent());
    }
}