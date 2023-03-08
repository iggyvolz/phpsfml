<?php

use iggyvolz\SFML\System\SystemLib;

require_once __DIR__ . "/vendor/autoload.php";
$graphicsLib = new \iggyvolz\SFML\Graphics\GraphicsLib(__DIR__ . "/CSFML/lib/libcsfml-graphics.so");

$transform = \iggyvolz\SFML\Graphics\Transform::getIdentity($graphicsLib);
$transform->scale(2, 3);
$transform->translate(1, 0);
var_dump($transform);