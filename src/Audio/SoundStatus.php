<?php

namespace iggyvolz\SFML\Audio;

enum SoundStatus: int
{
    case Stopped = 0;
    case Paused = 1;
    case Playing = 2;
}
