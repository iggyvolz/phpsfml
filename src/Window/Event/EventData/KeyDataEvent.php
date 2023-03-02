<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Window\Event;
use iggyvolz\SFML\Window\KeyCode;
use iggyvolz\SFML\Window\Window;

abstract class KeyDataEvent extends Event
{
    public readonly ?KeyCode $KeyCode;
    public readonly bool $Alt;
    public readonly bool $Control;
    public readonly bool $Shift;
    public readonly bool $System;

    public function __construct(
        Window $window,
        // sfEvent<sfKeyEvent>
        CData $cdata
    )
    {
        parent::__construct($window);
        $this->KeyCode = KeyCode::tryFrom($cdata->key->code);
        $this->Alt = $cdata->key->alt === 1;
        $this->Control = $cdata->key->control === 1;
        $this->Shift = $cdata->key->shift === 1;
        $this->System = $cdata->key->system === 1;
    }

}