<?php

namespace App\Connection;

class Board
{
    /**
     * @var PointInterface[]|array
     */
    private array $points = [];

    public function conductPoints(): void
    {
        foreach ($this->points as $point) {
            /**
             * @var PortInterface $outPort
             * @var PortInterface $inPort
             */
            foreach ($point->getMap() as [$outPort, $inPort]) {
                $this->conductPoint($outPort, $inPort);

                $nextPoint = $this->getNextPoint($inPort);
                if (null === $nextPoint) {
                    continue;
                }
                foreach ($nextPoint->getMap() as [$nOutPort, $nInPort]) {
                    $this->conductPoint($nOutPort, $nInPort);
                }
            }
        }
    }

    public function addPoint(PointInterface $point): void
    {
        $this->points[] = $point;
    }

    private function conductPoint(PortInterface $outPort, PortInterface $inPort): void
    {
        $outGadget = $outPort->getGadget();
        $outGadget->updateOut();
        $outGadget->isOutCurrent() ? $inPort->allowCurrent() : $inPort->stopCurrent();
        $inGadget = $inPort->getGadget();
        $inGadget->updateOut();
    }

    private function getNextPoint(PortInterface $inPort): ?PointInterface
    {
        $gadget = $inPort->getGadget();
        $outPort = $gadget->getOut();

        return $outPort->getPoint();
    }
}