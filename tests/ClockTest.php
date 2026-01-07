<?php

use iggyvolz\SFML\System\Clock;
use iggyvolz\SFML\System\Time;
use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . "/../vendor/autoload.php";
Environment::setup();
$clock = new Clock();
echo "Sleeping 2 seconds...";
\iggyvolz\SFML\sleep(Time::fromSeconds(2.0));
echo " Done" . PHP_EOL;
$time = $clock->elapsedTime;
$deltaFromActual = 2 - $time->seconds;
Assert::true($deltaFromActual > -0.1 && $deltaFromActual < 0.1);
echo "Sleeping 2 seconds...";
\iggyvolz\SFML\sleep(Time::fromSeconds(2));
echo " Done" . PHP_EOL;
$restartTime = $clock->restart();
$deltaFromActual = 4 - $restartTime->seconds;
Assert::true($deltaFromActual > -0.1 && $deltaFromActual < 0.1);
echo "Sleeping 2 seconds...";
\iggyvolz\SFML\sleep(Time::fromSeconds(2));
echo " Done" . PHP_EOL;
$finalTime = $clock->restart();
$deltaFromActual = 2 - $finalTime->seconds;
Assert::true($deltaFromActual > -0.1 && $deltaFromActual < 0.1);

