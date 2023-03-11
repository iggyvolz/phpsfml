<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Utils\BitmapEnum;

enum TextStyle: int
{
    case Bold = 0;
    case Italic = 1;
    case Underlined = 2;
    case StrikeThrough = 3;
    use BitmapEnum;
}
