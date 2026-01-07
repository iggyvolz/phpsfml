<?php

namespace iggyvolz\SFML\Window;

use iggyvolz\SFML\Utils\BitmapEnum;

enum Style: int
{
    case Titlebar = 0;
    case Resize = 1;
    case Close = 2;
    const default = [self::Titlebar, self::Resize, self::Close];
    use BitmapEnum;
}