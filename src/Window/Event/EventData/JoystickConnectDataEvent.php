<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;

abstract class JoystickConnectDataEvent extends Event
{
    public function getJoystickId(): int
    {
        return $this->cdata->joystickId;
    }
    public function setJoystickId(int $joystickId): void
    {
        $this->cdata->joystickId = $joystickId;
    }
}