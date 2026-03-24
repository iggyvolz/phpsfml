<?php

namespace iggyvolz\SFML\Window;

use Spem;

final class Touch
{
    private function __construct()
    {
    }

    #[Spem("touch_isDown")]
    public static function isDown(int $finger): bool {}

    /**
     * @return array{0: int, 1: int}
     */
    #[Spem("touch_getPosition")]
    public static function getPosition(int $finger, ?WindowBase $relativeTo = null): array {}

}