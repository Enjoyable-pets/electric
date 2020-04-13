<?php

namespace App\Tests\Connection;

use App\Connection\Wire;
use PHPUnit\Framework\TestCase;

class WireTest extends TestCase
{
    public function testWireShouldConductOutput(): void
    {
        $wire = new Wire();
        $this->assertFalse($wire->isOutCurrent());
        $wire->allowInACurrent();
        $this->assertTrue($wire->isOutCurrent());
        $wire->stopInACurrent();
        $this->assertFalse($wire->isOutCurrent());
    }
}