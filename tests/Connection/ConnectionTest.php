<?php

namespace App\Tests\Connection;

use App\Connection\Board;
use App\Connection\Nand;
use App\Connection\Point;
use App\Connection\Wire;
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    public function testThreeNandConnectionWithWires(): void
    {
        $nand1 = new Nand();
        $nand2 = new Nand();
        $nand3 = new Nand();
        $wire1 = new Wire();
        $wire2 = new Wire();
        $wire3 = new Wire();
        $point1 = new Point();
        $point2 = new Point();
        $point3 = new Point();
        $point4 = new Point();
        $point5 = new Point();
        $point1->mapPorts($nand1->getOut(), $wire1->getInA());
        $point2->mapPorts($wire1->getOut(), $nand3->getInA());
        $point3->mapPorts($nand2->getOut(), $wire2->getInA());
        $point4->mapPorts($wire2->getOut(), $nand3->getInB());
        $point5->mapPorts($nand3->getOut(), $wire3->getInA());

        $board = new Board();
        $board->addPoint($point1);
        $board->addPoint($point2);
        $board->addPoint($point3);
        $board->addPoint($point4);
        $board->addPoint($point5);

        $board->conductPoints();

        $this->assertFalse($wire3->isOutCurrent());
    }

    public function testRamBitOutput(): void
    {
        $nand1 = new Nand();
        $nand2 = new Nand();
        $nand3 = new Nand();
        $nand4 = new Nand();
        $wire1 = new Wire();
        $wire2 = new Wire();
        $wire3 = new Wire();
        $wire4 = new Wire();
        $wire5 = new Wire();
        $wire6 = new Wire();
        $wire7 = new Wire();
        $wire8 = new Wire();
        $wire9 = new Wire();
        $wire10 = new Wire();
        $wire11 = new Wire();
        $wire12 = new Wire();
        $point1 = new Point();
        $point2 = new Point();
        $point3 = new Point();
        $point4 = new Point();
        $point5 = new Point();
        $point6 = new Point();
        $point7 = new Point();
        $point8 = new Point();
        $point9 = new Point();
        $point10 = new Point();
        $point11 = new Point();
        $point12 = new Point();
        $point13 = new Point();
        $point14 = new Point();
        $point15 = new Point();
        $point1->mapPorts($wire1->getOut(), $nand1->getInA());
        $point2->mapPorts($wire2->getOut(), $wire3->getInA());
        $point2->mapPorts($wire2->getOut(), $wire4->getInA());
        $point3->mapPorts($wire3->getOut(), $nand1->getInB());
        $point4->mapPorts($nand1->getOut(), $wire5->getInA());
        $point5->mapPorts($wire5->getOut(), $wire6->getInA());
        $point5->mapPorts($wire5->getOut(), $wire7->getInA());
        $point6->mapPorts($wire7->getOut(), $nand2->getInA());
        $point7->mapPorts($wire4->getOut(), $nand2->getInB());
        $point8->mapPorts($nand2->getOut(), $wire8->getInA());
        $point9->mapPorts($wire6->getOut(), $nand3->getInA());
        $point12->mapPorts($wire8->getOut(), $nand4->getInB());
        $point13->mapPorts($nand3->getOut(), $wire9->getInA());
        $point14->mapPorts($nand4->getOut(), $wire11->getInA());
        $point15->mapPorts($wire9->getOut(), $wire12->getInA());
        $point15->mapPorts($wire9->getOut(), $wire10->getInA());
        $point10->mapPorts($wire11->getOut(), $nand3->getInB());
        $point11->mapPorts($wire10->getOut(), $nand4->getInA());

        $board = new Board();
        $board->addPoint($point1);
        $board->addPoint($point2);
        $board->addPoint($point3);
        $board->addPoint($point4);
        $board->addPoint($point5);
        $board->addPoint($point6);
        $board->addPoint($point7);
        $board->addPoint($point8);
        $board->addPoint($point9);
        $board->addPoint($point10);
        $board->addPoint($point11);
        $board->addPoint($point12);
        $board->addPoint($point13);
        $board->addPoint($point14);
        $board->addPoint($point15);

        $board->conductPoints();
        $this->assertFalse($wire12->isOutCurrent());

        $wire1->allowInACurrent();
        $wire2->allowInACurrent();
        $board->conductPoints();
        $this->assertTrue($wire12->isOutCurrent());

        $wire2->stopInACurrent();
        $wire1->stopInACurrent();
        $board->conductPoints();
        $this->assertTrue($wire12->isOutCurrent());

        $wire1->allowInACurrent();
        $board->conductPoints();
        $this->assertTrue($wire12->isOutCurrent());

        $wire1->stopInACurrent();
        $board->conductPoints();
        $this->assertTrue($wire12->isOutCurrent());

        $wire2->allowInACurrent();
        $board->conductPoints();
        $this->assertFalse($wire12->isOutCurrent());
    }
}