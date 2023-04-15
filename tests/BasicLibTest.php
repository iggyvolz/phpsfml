<?php

use iggyvolz\SFML\Audio\AudioLib;
use iggyvolz\SFML\Graphics\GraphicsLib;
use iggyvolz\SFML\Network\NetworkLib;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\Window\WindowLib;
use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . "/../vendor/autoload.php";
Environment::setup();
$systemLib = new SystemLib(__DIR__ . "/../CSFML/lib/libcsfml-system.so");
$windowLib = new WindowLib(__DIR__ . "/../CSFML/lib/libcsfml-window.so");
$graphicsLib = new GraphicsLib(__DIR__ . "/../CSFML/lib/libcsfml-graphics.so");
$audioLib = new AudioLib(__DIR__ . "/../CSFML/lib/libcsfml-audio.so");
$networkLib = new NetworkLib(__DIR__ . "/../CSFML/lib/libcsfml-network.so");
Assert::true(true);