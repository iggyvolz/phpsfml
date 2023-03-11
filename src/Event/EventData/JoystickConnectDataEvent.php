<?php

namespace iggyvolz\SFML\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Event\Event;
use iggyvolz\SFML\Window\Window;

abstract class JoystickConnectDataEvent extends Event
{
    public readonly int $JoystickId;

    public function __construct(
        Window $window,
        // sfEvent<sfJoystickConnectEvent>
        CData          $cdata
    )
    {
        parent::__construct($window);
        $this->JoystickId = $cdata->joystickButton->joystickId;

    }
}