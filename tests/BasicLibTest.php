<?php

use iggyvolz\SFML\Audio\AudioLib;
use iggyvolz\SFML\Graphics\GraphicsLib;
use iggyvolz\SFML\Network\NetworkLib;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\Window\WindowLib;
use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . "/../vendor/autoload.php";
Environment::setup();
$sfml = new Sfml(
    __DIR__ . "/../../CSFML/lib/libcsfml-audio.so",
    __DIR__ . "/../../CSFML/lib/libcsfml-graphics.so",
    __DIR__ . "/../../CSFML/lib/libcsfml-network.so",
    __DIR__ . "/../../CSFML/lib/libcsfml-system.so",
    __DIR__ . "/../../CSFML/lib/libcsfml-window.so",
);
Assert::true(true);