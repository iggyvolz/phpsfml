<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;

/**
 * @deprecated
 */
abstract class MouseWheelDataEvent extends Event
{
    public function getDelta(): int
    {
        return $this->cdata->delta;
    }
    public function setDelta(int $delta): void
    {
        $this->cdata->delta = $delta;
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