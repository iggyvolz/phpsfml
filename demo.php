<?php

use iggyvolz\SFML\Window\EventType;
use iggyvolz\SFML\Window\Window;
use iggyvolz\SFML\Window\WindowLib;

require_once __DIR__ . "/vendor/autoload.php";
$windowLib = new WindowLib(__DIR__ . "/CSFML/lib/libcsfml-window.so");
$window = Window::create(
    $windowLib,
    "abcdefghijklmnopqrstuvwxyz",
);
$close = false;
while(!$close) {
    $event = $window->pollEvent();
    $name = $event?->getType()?->name;
    if($name !== null) {
        echo "$name\n";
    }
    if($event?->getType() === EventType::sfEvtClosed) {
        $close = true;
    }
}