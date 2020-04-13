<?php

namespace App\Connection;

abstract class Port implements PortInterface
{
    private bool $current;
    private ?PointInterface $point = null;
    private GadgetInterface $gadget;

    public function __construct(GadgetInterface $gadget, bool $current = false)
    {
        $this->gadget = $gadget;
        $this->current = $current;
    }

    public function allowCurrent(): void
    {
        $this->current = true;
    }

    public function stopCurrent(): void
    {
        $this->current = false;
    }

    public function isCurrent(): bool
    {
        return $this->current;
    }

    public function getPoint(): ?PointInterface
    {
        return $this->point;
    }

    public function setPoint(PointInterface $point): void
    {
        $this->point = $point;
    }

    public function getGadget(): GadgetInterface
    {
        return $this->gadget;
    }

    public function setGadget(GadgetInterface $gadget): void
    {
        $this->gadget = $gadget;
    }
}