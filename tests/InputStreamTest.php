<?php

use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Time;
use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . "/../vendor/autoload.php";
Environment::setup();
$systemLib = new SystemLib(__DIR__ . "/../CSFML/lib/libcsfml-system.so");
$inputStream = \iggyvolz\SFML\System\InputStream::createFromString($systemLib, "foo bar");
Assert::same("f", $inputStream->read(1));
Assert::same("oo b", $inputStream->read(4));
Assert::same(5, $inputStream->tell());
Assert::same(7, $inputStream->getSize());
$inputStream->seek(2);
Assert::same("o b", $inputStream->read(3));