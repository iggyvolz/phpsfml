<?php

namespace iggyvolz\SFML\Window;

use Spem;

final class Keyboard
{
    private function __construct()
    {
    }

    #[Spem("libphpsfml.so", "keyboard_isKeyPressed")]
    public static function isKeyPressed(Key|Scancode $key): bool {}
    #[Spem("libphpsfml.so", "keyboard_setVirtualKeyboardVisible")]
    public static function setVirtualKeyboardVisible(bool $visible): void {}

}