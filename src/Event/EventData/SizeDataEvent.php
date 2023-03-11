<?php

namespace iggyvolz\SFML\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Event\Event;
use iggyvolz\SFML\Window\Window;

abstract class SizeDataEvent extends Event
{
    public readonly int $Width;
    public readonly int $Height;

    public function __construct(
        Window $window,
        // sfEvent<sfSizeEvent>
        CData          $cdata
    )
    {
        parent::__construct($window);
        $this->Width = $cdata->size->width;
        $this->Height = $cdata->size->height;
    }
}