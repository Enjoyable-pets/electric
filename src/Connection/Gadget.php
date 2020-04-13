<?php

namespace App\Connection;

abstract class Gadget implements GadgetInterface
{
    abstract public function updateOut(): void;

    public function informPoint(PortInterface $port): void
    {
        $point = $port->getPoint();
        if (null !== $point) {
            $point->updateMap();
        }
    }
}