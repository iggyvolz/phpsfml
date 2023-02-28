<?php

use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Time;
use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . "/../vendor/autoload.php";
Environment::setup();
$systemLib = new SystemLib(__DIR__ . "/../CSFML/lib/libcsfml-system.so");
$clock = \iggyvolz\SFML\System\Clock::create($systemLib);
$systemLib->sleep(Time::fromSeconds($systemLib, 2));
$time = $clock->getElapsedTime();
$deltaFromActual = 2 - $time->asSeconds();
Assert::true($deltaFromActual > -0.1 && $deltaFromActual < 0.1);
$systemLib->sleep(Time::fromSeconds($systemLib, 2));
$restartTime = $clock->restart();
$deltaFromActual = 4 - $restartTime->asSeconds();
Assert::true($deltaFromActual > -0.1 && $deltaFromActual < 0.1);
$systemLib->sleep(Time::fromSeconds($systemLib, 2));
$finalTime = $clock->restart();
$deltaFromActual = 2 - $finalTime->asSeconds();
Assert::true($deltaFromActual > -0.1 && $deltaFromActual < 0.1);

