<?php

namespace iggyvolz\SFML\Window;

use Spem;

final class Keyboard
{
    private function __construct()
    {
    }

    #[Spem("keyboard_isKeyPressed")]
    public static function isKeyPressed(Key|Scancode $key): bool {}
    #[Spem("keyboard_setVirtualKeyboardVisible")]
    public static function setVirtualKeyboardVisible(bool $visible): void {}

}