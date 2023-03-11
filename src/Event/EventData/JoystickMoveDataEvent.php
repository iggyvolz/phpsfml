<?php

namespace iggyvolz\SFML\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Event\Event;
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
        CData          $cdata
    )
    {
        parent::__construct($window);
        var_dump($cdata);
        $this->JoystickId = $cdata->joystickMove->joystickId;
        $this->Axis = JoystickAxis::from($cdata->joystickMove->axis);
        $this->Position = $cdata->joystickMove->position;

    }

}