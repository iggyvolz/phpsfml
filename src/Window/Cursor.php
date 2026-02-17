<?php

namespace iggyvolz\SFML\Window;

final class Cursor
{
    private function __construct()
    {
    }
    #[\Spem("libphpsfml.so", "cursor_createFromPixels")]
    public static function createFromPixels(string $pixels, int $width, int $height, int $hotspotX, int $hotspotY): ?self {}
    #[\Spem("libphpsfml.so", "cursor_createFromSystem")]
    public static function createFromSystem(CursorType $type): ?self {}
    #[\Spem("libphpsfml.so", "cursor_destruct")]
    public function __destruct()
    {
    }

}