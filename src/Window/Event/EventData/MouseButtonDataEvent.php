<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;
use iggyvolz\SFML\Window\MouseButton;

abstract class MouseButtonDataEvent extends Event
{
    public function getButton(): MouseButton
    {
        return MouseButton::from($this->cdata->button);
    }
    public function setButton(MouseButton $button): void
    {
        $this->cdata->button = $button->value;
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