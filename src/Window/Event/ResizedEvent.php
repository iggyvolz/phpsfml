<?php

namespace iggyvolz\SFML\Window\Event;

final class ResizedEvent extends Event
{
    public int $width {#[\Spem("resizedevent_getwidth")]get {}}
    public int $height { #[\Spem("resizedevent_getheight")]get {}}

    public function __debugInfo(): ?array
    {
        return ["width" => $this->width, "height" => $this->height];
    }
}