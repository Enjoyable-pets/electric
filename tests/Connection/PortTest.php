<?php

namespace App\Tests\Connection;

use App\Connection\InA;
use App\Connection\Nand;
use PHPUnit\Framework\TestCase;

class PortTest extends TestCase
{
    public function testPortShouldHandleCurrent(): void
    {
        $port = new InA(new Nand());
        $this->assertFalse($port->isCurrent());
        $port->allowCurrent();
        $this->assertTrue($port->isCurrent());
        $port->stopCurrent();
        $this->assertFalse($port->isCurrent());
    }
}