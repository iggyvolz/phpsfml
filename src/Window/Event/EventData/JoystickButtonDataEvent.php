<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;

abstract class JoystickButtonDataEvent extends Event
{
    public function getJoystickId(): int
    {
        return $this->cdata->joystickId;
    }
    public function setJoystickId(int $joystickId): void
    {
        $this->cdata->joystickId = $joystickId;
    }
    public function getButton(): int
    {
        return $this->cdata->button;
    }
    public function setButton(int $button): void
    {
        $this->cdata->button = $button;
    }
}