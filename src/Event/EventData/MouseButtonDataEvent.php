<?php

namespace iggyvolz\SFML\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Event\Event;
use iggyvolz\SFML\Window\MouseButton;
use iggyvolz\SFML\Window\Window;

abstract class MouseButtonDataEvent extends Event
{
    public readonly MouseButton $Button;
    public readonly int $X;
    public readonly int $Y;

    public function __construct(
        Window $window,
        // sfEvent<sfMouseButtonEvent>
        CData          $cdata
    )
    {
        parent::__construct($window);
        $this->Button = MouseButton::from($cdata->mouseButton->button);
        $this->X = $cdata->mouseButton->x;
        $this->Y = $cdata->mouseButton->y;
    }

}