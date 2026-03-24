<?php

namespace iggyvolz\SFML\Window;

use Spem;

final class Mouse
{
    private function __construct()
    {
    }

    #[Spem("mouse_isButtonPressed")]
    public static function isButtonPressed(MouseButton $button): bool {}

    /**
     * @return array{0: int, 1: int}
     */
    #[Spem("mouse_getPosition")]
    public static function getPosition(?WindowBase $relativeTo = null): array {}

    #[Spem("mouse_setPosition")]
    public static function setPosition(int $x, int $y, ?WindowBase $relativeTo = null): void {}

}