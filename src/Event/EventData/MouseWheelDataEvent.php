<?php

namespace iggyvolz\SFML\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Event\Event;
use iggyvolz\SFML\Window\Window;

/**
 * @deprecated
 */
abstract class MouseWheelDataEvent extends Event
{
    public readonly int $Delta;
    public readonly int $X;
    public readonly int $Y;
    public function __construct(
        Window $window,
        // sfEvent<sfMouseWheelEvent>
        CData          $cdata
    )
    {
        parent::__construct($window);
        $this->Delta = $cdata->mouseWheel->delta;
        $this->X = $cdata->mouseWheel->x;
        $this->Y = $cdata->mouseWheel->y;
    }
}