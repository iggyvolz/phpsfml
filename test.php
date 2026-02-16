<?php

use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\Utils\SfString;
use iggyvolz\SFML\Window\Event\ClosedEvent;
use iggyvolz\SFML\Window\Event\KeyPressedEvent;
use iggyvolz\SFML\Window\Event\KeyReleasedEvent;
use iggyvolz\SFML\Window\Key;
use iggyvolz\SFML\Window\State;
use iggyvolz\SFML\Window\VideoMode;
use iggyvolz\SFML\Window\WindowBase;
use iggyvolz\SFML\Window\Style;
use Revolt\EventLoop;
use function iggyvolz\SFML\sleep;

require 'vendor/autoload.php';
$window = new WindowBase(
    new VideoMode(800, 600),
    new SfString("SFML window"),
//    [Style::Close],
//    State::Fullscreen,
);
var_dump($window->size);
$window->size = [400, 300];
var_dump($window->size);

$window->title = new SfString("New title");

EventLoop::repeat(0.1, function(string $callbackId) use($window){
        while($event = $window->pollEvent()) {
//    var_dump($event);
//        echo get_debug_type($event) . PHP_EOL;
//    if($event instanceof KeyPressedEvent || $event instanceof KeyReleasedEvent) {
//        var_dump($event);
//    }
            if($event instanceof \iggyvolz\SFML\Window\Event\TextEnteredEvent) {
                echo $event->string;
            }
            if($event instanceof ClosedEvent || ($event instanceof KeyPressedEvent && $event->code === Key::Escape)) {
                $window->close();
                EventLoop::cancel($callbackId);
            }
        }
});
EventLoop::run();