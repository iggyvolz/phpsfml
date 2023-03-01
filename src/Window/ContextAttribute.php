<?php

namespace iggyvolz\SFML\Window;

use iggyvolz\SFML\Utils\BitmapEnum;

enum ContextAttribute: int
{
    case Core = 0;
    case Debug = 2;
    const default = [];
    use BitmapEnum;
}