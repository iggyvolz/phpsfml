<?php

namespace iggyvolz\SFML\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Event\Event;
use iggyvolz\SFML\Window\MouseWheel;
use iggyvolz\SFML\Window\Window;

abstract class MouseWheelScrollDataEvent extends Event
{
    public readonly MouseWheel $Wheel;
    public readonly int $Delta;
    public readonly int $X;
    public readonly int $Y;

    public function __construct(
        Window $window,
        // sfEvent<sfMouseWheelScrollEvent>
        CData          $cdata
    )
    {
        parent::__construct($window);
        $this->Wheel = MouseWheel::from($cdata->mouseWheelScroll->wheel);
        $this->Delta = $cdata->mouseWheelScroll->delta;
        $this->X = $cdata->mouseWheelScroll->x;
        $this->Y = $cdata->mouseWheelScroll->y;
    }

}