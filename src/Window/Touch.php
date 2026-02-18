<?php

namespace iggyvolz\SFML\Window;

use Spem;

final class Touch
{
    private function __construct()
    {
    }

    #[Spem("libphpsfml.so", "touch_isDown")]
    public static function isDown(int $finger): bool {}

    /**
     * @return array{0: int, 1: int}
     */
    #[Spem("libphpsfml.so", "touch_getPosition")]
    public static function getPosition(int $finger, ?WindowBase $relativeTo = null): array {}

}