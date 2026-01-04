<?php

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\InputStream;
use iggyvolz\SFML\System\InputStreamFromString;
use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . "/../vendor/autoload.php";
Environment::setup();
$inputStream = InputStream::createFromString("foo bar");
Assert::same("f", $inputStream->read(1));
Assert::same("oo b", $inputStream->read(4));
Assert::same(5, $inputStream->tell());
Assert::same(7, $inputStream->size);
$inputStream->seek(2);
Assert::same("o b", $inputStream->read(3));
