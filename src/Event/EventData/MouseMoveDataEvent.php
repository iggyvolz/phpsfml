<?php

namespace iggyvolz\SFML\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Event\Event;
use iggyvolz\SFML\Window\Window;

abstract class MouseMoveDataEvent extends Event
{
    public readonly int $X;
    public readonly int $Y;
    public function __construct(
        Window $window,
        // sfEvent<sfKeyEvent>
        CData          $cdata
    )
    {
        parent::__construct($window);
        $this->X = $cdata->mouseMove->x;
        $this->Y = $cdata->mouseMove->y;
    }
}