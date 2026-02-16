<?php

namespace iggyvolz\SFML\Window\Event;

final class TextEnteredEvent extends Event
{
    public int $unicode {#[\Spem("libphpsfml.so", "textentered_unicode")]get {}}
    public string $string {
        get {
            $code = $this->unicode;
            if ($code <= 0x007f) {
                return chr($code);
            }
            if ($code <= 0x07ff) {
                return chr(($code >> 6) + 0xc0) . chr(($code & 0x3f) + 0x80);

            }
            if ($code <= 0xffff) {
                return chr(($code >> 12) + 0xe0) . chr((($code >> 6) & 0x3f) + 0x80) . chr(($code & 0x3f) + 0x80);
            }
            return chr(($code >> 18) + 0xf0) . chr((($code >> 12) & 0x3f) + 0x80) . chr((($code >> 6) & 0x3f) + 0x80) . chr(($code & 0x3f) + 0x80);
        }
    }

    public function __debugInfo(): ?array
    {
        return ["unicode" => $this->unicode, "string" => $this->string];
    }
}