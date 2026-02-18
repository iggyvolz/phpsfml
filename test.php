<?php

use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\Utils\SfString;
use iggyvolz\SFML\Window\ContextSettings;
use iggyvolz\SFML\Window\CursorType;
use iggyvolz\SFML\Window\Event\ClosedEvent;
use iggyvolz\SFML\Window\Event\KeyPressedEvent;
use iggyvolz\SFML\Window\Event\KeyReleasedEvent;
use iggyvolz\SFML\Window\Joystick\Axis;
use iggyvolz\SFML\Window\Joystick\Joystick;
use iggyvolz\SFML\Window\Key;
use iggyvolz\SFML\Window\Scancode;
use iggyvolz\SFML\Window\State;
use iggyvolz\SFML\Window\VideoMode;
use iggyvolz\SFML\Window\WindowBase;
use iggyvolz\SFML\Window\Style;
use Revolt\EventLoop;
use function iggyvolz\SFML\sleep;

require 'vendor/autoload.php';
$sett = new ContextSettings();
$window = new WindowBase(
    new VideoMode(800, 600),
    new SfString("SFML window"),
//    [Style::Close],
//    State::Fullscreen,
);

var_dump(\iggyvolz\SFML\Window\Vulkan::getGraphicsRequiredInstanceExtensions());
//$window->mouseCursor = \iggyvolz\SFML\Window\Cursor::createFromSystem(CursorType::Help);
//var_dump($window->size);
//$window->size = [400, 300];
//var_dump($window->size);
//var_dump(\iggyvolz\SFML\getClipboard()->toString());
//\iggyvolz\SFML\setClipboard(new SfString("Hello world"));
//foreach(Joystick::getConnected() as $i => $joystick) {
//    echo "Joystick $i: " . $joystick->name . PHP_EOL;
//    echo "  Vendor ID: " . $joystick->vendorId . PHP_EOL;
//    echo "  Product ID: " . $joystick->productId . PHP_EOL;
//    echo "  Button count: " . $joystick->buttonCount . PHP_EOL;
//    foreach(Axis::cases() as $axis) {
//        echo "  Axis " . $axis->name . ": " . ($joystick->hasAxis($axis) ? "Yes" : "No") . PHP_EOL;
//    }
//}

var_dump(Scancode::Apostrophe->localize()->name);
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

//EventLoop::repeat(1, function(string $callbackId) use($window){
//    if(!$window->isOpen) {
//        EventLoop::cancel($callbackId);
//        return;
//    }
//
//    $joystick = Joystick::get(0);
//    for($i = 0; $i < $joystick->buttonCount; $i++) {
//        echo "Button $i: " . ($joystick->isButtonPressed($i) ? "Pressed" : "Released") . PHP_EOL;
//    }
//    foreach (Axis::cases() as $axis) {
//        if($joystick->hasAxis($axis))
//        {
//            echo "Axis $axis->name: " . $joystick->getAxisPosition($axis) . PHP_EOL;
//        }
//    }
//
//    echo "--------" . PHP_EOL;
//});
EventLoop::run();