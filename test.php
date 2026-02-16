<?php

use iggyvolz\SFML\System\Time;
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
    "SFML window",
//    windowStyle: [Style::Close],
//    state: State::Fullscreen
);
EventLoop::repeat(0.1, function() use($window){
        while($event = $window->pollEvent()) {
//    var_dump($event);
        echo get_debug_type($event) . PHP_EOL;
//    if($event instanceof KeyPressedEvent || $event instanceof KeyReleasedEvent) {
//        var_dump($event);
//    }
            if($event instanceof \iggyvolz\SFML\Window\Event\TextEnteredEvent) {
//                echo $event->string . PHP_EOL;
            }
            if($event instanceof ClosedEvent || ($event instanceof KeyPressedEvent && $event->code === Key::Escape)) {
                $window->close();
            }
        }
});
EventLoop::run();