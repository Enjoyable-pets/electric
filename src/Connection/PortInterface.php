<?php

namespace App\Connection;

interface PortInterface
{
    public function isCurrent(): bool;
    public function allowCurrent(): void;
    public function stopCurrent(): void;
    public function getPoint(): ?PointInterface;
    public function setPoint(PointInterface $point): void;
    public function getGadget(): GadgetInterface;
    public function setGadget(GadgetInterface $gadget): void;
}