<?php

namespace App\Connection;

interface GadgetInterface
{
    public function updateOut(): void;
    public function informPoint(PortInterface $port): void;
    public function isOutCurrent(): bool;
    public function getOut(): PortInterface;
}