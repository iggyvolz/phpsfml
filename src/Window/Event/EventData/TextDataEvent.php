<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;

abstract class TextDataEvent extends Event
{
    public function getChar(string $encoding = "UTF-8"): string
    {
        // This is an interesting on - we get the character back as a single codepoint which PHP "helpfully" interprets as a number
        // We need to repack this into a UTF-32 string, then convert the encoding
        return mb_convert_encoding(pack("L", $this->getUnicode()), $encoding, "UTF-32LE");
    }
    public function setChar(string $text, string $encoding = "UTF-8"): void
    {
        $this->setUnicode(unpack("L", mb_convert_encoding($text, "UTF-32LE", $encoding))[1]);
    }

    public function getUnicode(): int
    {
        return $this->cdata->unicode;
    }
    public function setUnicode(int $unicode): void
    {
        $this->cdata->unicode = $unicode;
    }
}