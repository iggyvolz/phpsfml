<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;

abstract class SizeDataEvent extends Event
{
    public function getWidth(): int
    {
        return $this->cdata->width;
    }
    public function setWidth(int $width): void
    {
        $this->cdata->width = $width;
    }
    public function getHeight(): int
    {
        return $this->cdata->height;
    }
    public function setHeight(int $height): void
    {
        $this->cdata->height = $height;
    }
}