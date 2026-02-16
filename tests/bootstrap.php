<?php

use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . "/../vendor/autoload.php";
Environment::setup();

function assert_close(float $expected, float $actual, float $delta = 0.000001): void
{
    Assert::true($actual >= $expected - $delta && $actual <= $expected + $delta, "Expected $expected, got $actual");
}