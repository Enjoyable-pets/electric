<?php

namespace App\Connection;

class Wire extends Gadget
{
    private InA $inA;
    private Out $out;

    public function __construct()
    {
        $this->inA = new InA($this);
        $this->out = new Out($this);
    }

    public function allowInACurrent(): void
    {
        $this->inA->allowCurrent();
        $this->updateOut();
    }

    public function stopInACurrent(): void
    {
        $this->inA->stopCurrent();
        $this->updateOut();
    }

    public function isOutCurrent(): bool
    {
        $this->updateOut();

        return $this->out->isCurrent();
    }

    public function getInA(): InA
    {
        return $this->inA;
    }

    public function getOut(): Out
    {
        return $this->out;
    }

    public function updateOut(): void
    {
        $this->inA->isCurrent() ? $this->out->allowCurrent() : $this->out->stopCurrent();
        $this->informPoint($this->out);
    }
}