<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;

abstract class TouchDataEvent extends Event
{
    public readonly int $X;
    public readonly int $Y;

    public function getFinger(): int
    {
        return $this->cdata->finger;
    }
    public function setFinger(int $finger): void
    {
        $this->cdata->finger = $finger;
    }
    public function getX(): int
    {
        return $this->cdata->x;
    }
    public function setX(int $x): void
    {
        $this->cdata->x = $x;
    }
    public function getY(): int
    {
        return $this->cdata->y;
    }
    public function setY(int $y): void
    {
        $this->cdata->y = $y;
    }
}