<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;
use iggyvolz\SFML\Window\MouseWheel;

abstract class MouseWheelScrollDataEvent extends Event
{
    public readonly MouseWheel $Wheel;
    public function getWheel(): MouseWheel
    {
        return MouseWheel::from($this->cdata->wheel);
    }
    public function setWheel(MouseWheel $wheel): void
    {
        $this->cdata->wheel = $wheel->value;
    }
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