<?php

use iggyvolz\SFML\Window\Event;
use iggyvolz\SFML\Window\EventType;
use iggyvolz\SFML\Window\Window;
use iggyvolz\SFML\Window\WindowLib;
use League\Event\EventDispatcher;
use League\Event\ListenerRegistry;
use Revolt\EventLoop;

require_once __DIR__ . "/vendor/autoload.php";
$windowLib = new WindowLib(__DIR__ . "/CSFML/lib/libcsfml-window.so");
$window = Window::create(
    $windowLib,
    "abcdefghijklmnopqrstuvwxyz",
    eventDispatcher: $listener = new EventDispatcher(),
);
/** @var ListenerRegistry $listener */
$listener->subscribeTo(Event::class, function(Event $e): void {
    if($e->getType() === EventType::Closed) {
        $e->window->close();
    }
});
$listener->subscribeTo(Event::class, function(Event $e): void {
    echo $e->getType()->name . PHP_EOL;
});
EventLoop::run();
