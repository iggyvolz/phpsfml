<?php

namespace iggyvolz\SFML\Window;

final class Cursor
{
    private function __construct()
    {
    }
    #[\Spem("cursor_createFromPixels")]
    public static function createFromPixels(string $pixels, int $width, int $height, int $hotspotX, int $hotspotY): ?self {}
    #[\Spem("cursor_createFromSystem")]
    public static function createFromSystem(CursorType $type): ?self {}
    #[\Spem("cursor_destruct")]
    public function __destruct()
    {
    }

}