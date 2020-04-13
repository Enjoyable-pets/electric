<?php

namespace App\Connection;

class Nand extends Gadget
{
    private InA $inA;
    private InB $inB;
    private Out $out;

    public function __construct()
    {
        $this->inA = new InA($this);
        $this->inB = new InB($this);
        $this->out = new Out($this, true);
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

    public function allowInBCurrent(): void
    {
        $this->inB->allowCurrent();
        $this->updateOut();
    }

    public function stopInBCurrent(): void
    {
        $this->inB->stopCurrent();
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

    public function getInB(): InB
    {
        return $this->inB;
    }

    public function getOut(): Out
    {
        return $this->out;
    }

    public function updateOut(): void
    {
        $this->nandLogic() ? $this->out->allowCurrent() : $this->out->stopCurrent();
        $this->informPoint($this->out);
    }

    private function nandLogic(): bool
    {
        return !($this->inA->isCurrent() && $this->inB->isCurrent());
    }
}