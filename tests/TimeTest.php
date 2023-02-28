<?php

use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Time;
use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . "/../vendor/autoload.php";
Environment::setup();
$systemLib = new SystemLib(__DIR__ . "/../CSFML/lib/libcsfml-system.so");
$zero = Time::zero($systemLib);
Assert::same(0.0, $zero->asSeconds());
Assert::same(0, $zero->asMilliseconds());
Assert::same(0, $zero->asMicroseconds());
$oneAndAHalfSeconds = Time::fromSeconds($systemLib, 1.5);
Assert::same(1.5, $oneAndAHalfSeconds->asSeconds());
Assert::same(1_500, $oneAndAHalfSeconds->asMilliseconds());
Assert::same(1_500_000, $oneAndAHalfSeconds->asMicroseconds());
$twoSeconds = Time::fromMilliseconds($systemLib, 2_000);
Assert::same(2.0, $twoSeconds->asSeconds());
Assert::same(2_000, $twoSeconds->asMilliseconds());
Assert::same(2_000_000, $twoSeconds->asMicroseconds());
$twoAndAHalfSeconds = Time::fromMicroseconds($systemLib, 2_500_000);
Assert::same(2.5, $twoAndAHalfSeconds->asSeconds());
Assert::same(2_500, $twoAndAHalfSeconds->asMilliseconds());
Assert::same(2_500_000, $twoAndAHalfSeconds->asMicroseconds());