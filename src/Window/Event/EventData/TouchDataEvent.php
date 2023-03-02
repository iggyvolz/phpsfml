<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Window\Event;
use iggyvolz\SFML\Window\Window;

abstract class TouchDataEvent extends Event
{
    public readonly int $Finger;
    public readonly int $X;
    public readonly int $Y;
    public function __construct(
        Window $window,
        // sfEvent<sfTouchEvent>
        CData $cdata
    )
    {
        parent::__construct($window);
        $this->Finger = $cdata->touch->finger;
        $this->X = $cdata->touch->x;
        $this->Y = $cdata->touch->y;
    }
}