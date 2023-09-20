<?php

use iggyvolz\SFML\Sfml;
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
$zero = Time::zero($sfml);
Assert::same(0.0, $zero->asSeconds());
Assert::same(0, $zero->asMilliseconds());
Assert::same(0, $zero->asMicroseconds());
$oneAndAHalfSeconds = Time::fromSeconds($sfml, 1.5);
Assert::same(1.5, $oneAndAHalfSeconds->asSeconds());
Assert::same(1_500, $oneAndAHalfSeconds->asMilliseconds());
Assert::same(1_500_000, $oneAndAHalfSeconds->asMicroseconds());
$twoSeconds = Time::fromMilliseconds($sfml, 2_000);
Assert::same(2.0, $twoSeconds->asSeconds());
Assert::same(2_000, $twoSeconds->asMilliseconds());
Assert::same(2_000_000, $twoSeconds->asMicroseconds());
$twoAndAHalfSeconds = Time::fromMicroseconds($sfml, 2_500_000);
Assert::same(2.5, $twoAndAHalfSeconds->asSeconds());
Assert::same(2_500, $twoAndAHalfSeconds->asMilliseconds());
Assert::same(2_500_000, $twoAndAHalfSeconds->asMicroseconds());