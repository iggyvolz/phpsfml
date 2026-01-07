<?php

use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\Window\State;
use iggyvolz\SFML\Window\VideoMode;
use iggyvolz\SFML\Window\WindowBase;
use iggyvolz\SFML\Window\Style;
use function iggyvolz\SFML\sleep;

require 'vendor/autoload.php';
$window = new WindowBase(
    new VideoMode(800, 600),
    "SFML window",
//    windowStyle: [Style::Close],
//    state: State::Fullscreen
);
sleep(Time::fromSeconds(5));
unset($window);
sleep(Time::fromSeconds(5));
