<?php

namespace iggyvolz\SFML\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Event\Event;
use iggyvolz\SFML\Window\Window;

abstract class JoystickButtonDataEvent extends Event
{
    public readonly int $JoystickId;
    public readonly int $Button;

    public function __construct(
        Window $window,
        // sfEvent<sfJoystickButtonEvent>
        CData          $cdata
    )
    {
        parent::__construct($window);
        $this->JoystickId = $cdata->joystickButton->joystickId;
        $this->Button = $cdata->joystickButton->button;
    }
}