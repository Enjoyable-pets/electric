<?php

namespace App\Connection;

class Point implements PointInterface
{
    private array $map = [];

    public function updateMap(): void
    {
        $isCurrent = false;
        /**
         * @var PortInterface $outPort
         * @var PortInterface $inPort
         */
        foreach ($this->map as [$outPort, $inPort]) {
            if ($outPort->isCurrent()) {
                $isCurrent = true;
                break;
            }
        }

        /**
         * @var PortInterface $outPort
         * @var PortInterface $inPort
         */
        foreach ($this->map as [$outPort, $inPort]) {
            $isCurrent ? $inPort->allowCurrent() : $inPort->stopCurrent();
        }
    }

    public function mapPorts(PortInterface $outPort, PortInterface $inPort): void
    {
        $outPort->setPoint($this);
        $inPort->setPoint($this);

        $this->map[] = [$outPort, $inPort];

        $this->updateMap();
    }

    public function getMap(): array
    {
        return $this->map;
    }
}