<?php

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\InputStream;
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
$inputStream = InputStream::createFromString($sfml, "foo bar");
Assert::same("f", $inputStream->read(1));
Assert::same("oo b", $inputStream->read(4));
Assert::same(5, $inputStream->tell());
Assert::same(7, $inputStream->getSize());
$inputStream->seek(2);
Assert::same("o b", $inputStream->read(3));