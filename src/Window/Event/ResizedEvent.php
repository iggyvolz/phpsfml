<?php

namespace iggyvolz\SFML\Window\Event;

use FFI\CData;
use iggyvolz\SFML\Window\Event\EventData\SizeDataEvent;
use iggyvolz\SFML\Window\Window;

final class ResizedEvent extends SizeDataEvent
{
    public function __construct(Window $window, CData $cdata)
    {
//        var_dump($cdata);
        parent::__construct($window, $cdata);
    }
}