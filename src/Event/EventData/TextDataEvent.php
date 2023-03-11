<?php

namespace iggyvolz\SFML\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Event\Event;
use iggyvolz\SFML\Window\Window;

abstract class TextDataEvent extends Event
{
    private readonly int $unicode;
    public function __construct(
        Window $window,
        // sfEvent<sfTextEvent>
        CData          $cdata
    )
    {
        parent::__construct($window);
        $this->unicode = $cdata->text->unicode;
    }

    public function getText(string $encoding = "UTF-8"): string
    {
        // This is an interesting on - we get the character back as a single codepoint which PHP "helpfully" interprets as a number
        // We need to repack this into a UTF-32 string, then convert the encoding
        return mb_convert_encoding(pack("L", $this->unicode), $encoding, "UTF-32LE");
    }
}