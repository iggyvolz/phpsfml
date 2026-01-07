<?php

use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\System\Vector\Vector2I;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\System\Vector\Vector3F;
use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . "/../vendor/autoload.php";
Environment::setup();
$vectorOne = new Vector2I(1, 2);
Assert::same(1, $vectorOne->x);
Assert::same(2, $vectorOne->y);
$vectorOne->x = 3;
$vectorOne->y = 4;
Assert::same(3, $vectorOne->x);
Assert::same(4, $vectorOne->y);

$vectorTwo = new Vector2U(5, 6);
Assert::same(5, $vectorTwo->x);
Assert::same(6, $vectorTwo->y);
$vectorOne->x = 7;
$vectorOne->y = 8;
Assert::same(7, $vectorOne->x);
Assert::same(8, $vectorOne->y);

$vectorThree = new Vector2F(9.0, 10.0);
Assert::same(9.0, $vectorThree->x);
Assert::same(10.0, $vectorThree->y);
$vectorThree->x = 11.0;
$vectorThree->y = 12.0;
Assert::same(11.0, $vectorThree->x);
Assert::same(12.0, $vectorThree->y);

$vectorFour = new Vector3F(13.0, 14.0, 15.0);
Assert::same(13.0, $vectorFour->x);
Assert::same(14.0, $vectorFour->y);
Assert::same(15.0, $vectorFour->z);
$vectorFour->x = 16.0;
$vectorFour->y = 17.0;
$vectorFour->z = 18.0;
Assert::same(16.0, $vectorFour->x);
Assert::same(17.0, $vectorFour->y);
Assert::same(18.0, $vectorFour->z);
