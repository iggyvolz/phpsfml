<?php

namespace iggyvolz\SFML\Window;

use iggyvolz\SFML\Utils\BitmapEnum;

enum WindowStyle: int
{
    case Titlebar = 0;
    case Resize = 1;
    case Close = 2;
    case Fullscreen = 3;
    const default = [self::Titlebar, self::Resize, self::Close];
    use BitmapEnum;
}