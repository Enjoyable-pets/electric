<?php

namespace App\Connection;

interface PointInterface
{
    public function updateMap(): void;
    public function mapPorts(PortInterface $outPort, PortInterface $inPort): void;
    public function getMap(): array;
}