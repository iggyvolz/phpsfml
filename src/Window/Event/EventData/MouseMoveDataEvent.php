<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;

abstract class MouseMoveDataEvent extends Event
{
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
        $this->cdata->z = $y;
    }
}