<?php

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\System\Vector\Vector2I;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\System\Vector\Vector3F;
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
$vectorOne = Vector2I::create($sfml, 1, 2);
Assert::same(1, $vectorOne->getX());
Assert::same(2, $vectorOne->getY());
$vectorOne->setX(3);
$vectorOne->setY(4);
Assert::same(3, $vectorOne->getX());
Assert::same(4, $vectorOne->getY());

$vectorTwo = Vector2U::create($sfml, 5, 6);
Assert::same(5, $vectorTwo->getX());
Assert::same(6, $vectorTwo->getY());
$vectorOne->setX(7);
$vectorOne->setY(8);
Assert::same(7, $vectorOne->getX());
Assert::same(8, $vectorOne->getY());

$vectorThree = Vector2F::create($sfml, 9.0, 10.0);
Assert::same(9.0, $vectorThree->getX());
Assert::same(10.0, $vectorThree->getY());
$vectorThree->setX(11.0);
$vectorThree->setY(12.0);
Assert::same(11.0, $vectorThree->getX());
Assert::same(12.0, $vectorThree->getY());

$vectorFour = Vector3F::create($sfml, 13.0, 14.0, 15.0);
Assert::same(13.0, $vectorFour->getX());
Assert::same(14.0, $vectorFour->getY());
Assert::same(15.0, $vectorFour->getZ());
$vectorFour->setX(16.0);
$vectorFour->setY(17.0);
$vectorFour->setZ(18.0);
Assert::same(16.0, $vectorFour->getX());
Assert::same(17.0, $vectorFour->getY());
Assert::same(18.0, $vectorFour->getZ());
