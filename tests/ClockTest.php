<?php

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Clock;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Time;
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
$clock = Clock::create($sfml);
$sfml->system->sleep(Time::fromSeconds($sfml, 2));
$time = $clock->getElapsedTime();
$deltaFromActual = 2 - $time->asSeconds();
Assert::true($deltaFromActual > -0.1 && $deltaFromActual < 0.1);
$sfml->system->sleep(Time::fromSeconds($sfml, 2));
$restartTime = $clock->restart();
$deltaFromActual = 4 - $restartTime->asSeconds();
Assert::true($deltaFromActual > -0.1 && $deltaFromActual < 0.1);
$sfml->system->sleep(Time::fromSeconds($sfml, 2));
$finalTime = $clock->restart();
$deltaFromActual = 2 - $finalTime->asSeconds();
Assert::true($deltaFromActual > -0.1 && $deltaFromActual < 0.1);

