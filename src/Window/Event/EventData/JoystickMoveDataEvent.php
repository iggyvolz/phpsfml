<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;
use iggyvolz\SFML\Window\JoystickAxis;

abstract class JoystickMoveDataEvent extends Event
{
    public function getJoystickId(): int
    {
        return $this->cdata->joystickId;
    }
    public function setJoystickId(int $joystickId): void
    {
        $this->cdata->joystickId = $joystickId;
    }
    public function getJoystickAxis(): JoystickAxis
    {
        return JoystickAxis::from($this->cdata->joystickAxis);
    }
    public function setJoystickAxis(JoystickAxis $joystickAxis): void
    {
        $this->cdata->joystickAxis = $joystickAxis->value;
    }
    public function getPosition(): float
    {
        return $this->cdata->position;
    }
    public function setPosition(float $position): void
    {
        $this->cdata->position = $position;
    }

}