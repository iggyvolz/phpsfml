<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Window\Event;
use iggyvolz\SFML\Window\JoystickAxis;
use iggyvolz\SFML\Window\Window;

abstract class JoystickMoveDataEvent extends Event
{
    public readonly int $JoystickId;
    public readonly JoystickAxis $Axis;
    public readonly float $Position;

    public function __construct(
        Window $window,
        // sfEvent<sfJoystickMoveEvent>
        CData $cdata
    )
    {
        parent::__construct($window);
        $this->JoystickId = $cdata->joystickButton->joystickId;
        $this->Axis = JoystickAxis::from($cdata->joystickButton->axis);
        $this->Position = $cdata->joystickButton->position;

    }

}