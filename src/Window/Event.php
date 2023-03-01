<?php

namespace iggyvolz\SFML\Window;

use FFI\CData;

class Event
{

    /**
     * @param WindowLib $windowLib
     * @param CData $cdata
     */
    public function __construct(private readonly WindowLib $windowLib, public readonly Window $window, private readonly CData $cdata)
    {
    }

    public function getType(): EventType
    {
        return EventType::from($this->cdata->type);
    }
}