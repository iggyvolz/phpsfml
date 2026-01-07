<?php

use iggyvolz\SFML\System\Time;
use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . "/../vendor/autoload.php";
Environment::setup();
$zero = Time::zero();
Assert::same(0.0, $zero->seconds);
Assert::same(0, $zero->milliseconds);
Assert::same(0, $zero->microseconds);
$oneAndAHalfSeconds = Time::fromSeconds(1.5);
Assert::same(1.5, $oneAndAHalfSeconds->seconds);
Assert::same(1_500, $oneAndAHalfSeconds->milliseconds);
Assert::same(1_500_000, $oneAndAHalfSeconds->microseconds);
$twoSeconds = Time::fromMilliseconds( 2_000);
Assert::same(2.0, $twoSeconds->seconds);
Assert::same(2_000, $twoSeconds->milliseconds);
Assert::same(2_000_000, $twoSeconds->microseconds);
$twoAndAHalfSeconds = Time::fromMicroseconds( 2_500_000);
Assert::same(2.5, $twoAndAHalfSeconds->seconds);
Assert::same(2_500, $twoAndAHalfSeconds->milliseconds);
Assert::same(2_500_000, $twoAndAHalfSeconds->microseconds);