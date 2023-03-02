<?php

use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\Window\Event\ClosedEvent;
use iggyvolz\SFML\Window\Event\JoystickConnectedEvent;
use iggyvolz\SFML\Window\Event\KeyPressedEvent;
use iggyvolz\SFML\Window\Event\KeyReleasedEvent;
use iggyvolz\SFML\Window\Event\MouseButtonPressedEvent;
use iggyvolz\SFML\Window\Event\MouseButtonReleasedEvent;
use iggyvolz\SFML\Window\Event\MouseMovedEvent;
use iggyvolz\SFML\Window\Event\MouseWheelScrolledEvent;
use iggyvolz\SFML\Window\JoystickAxis;
use iggyvolz\SFML\Window\KeyCode;
use iggyvolz\SFML\Window\Window;
use iggyvolz\SFML\Window\WindowLib;
use League\Event\EventDispatcher;
use League\Event\ListenerRegistry;
use Revolt\EventLoop;

require_once __DIR__ . "/vendor/autoload.php";
//$systemLib = new SystemLib(__DIR__ . "/CSFML/CSFML-2.5.1-windows-64-bit/bin/csfml-system-2.dll");
//$windowLib = new WindowLib(__DIR__ . "/CSFML/CSFML-2.5.1-windows-64-bit/bin/csfml-window-2.dll", $systemLib);
$systemLib = new SystemLib(__DIR__ . "/CSFML/lib/libcsfml-system.so");
$windowLib = new WindowLib(__DIR__ . "/CSFML/lib/libcsfml-window.so", $systemLib);
$window = Window::create(
    $windowLib,
    "abcdefghijklmnopqrstuvwxyz",
    eventDispatcher: $listener = new EventDispatcher(),
);
/** @var ListenerRegistry $listener */
$listener->subscribeTo(ClosedEvent::class, function(ClosedEvent $e): void {
    $e->window->close();
});
$listener->subscribeTo(KeyPressedEvent::class, function(KeyPressedEvent $e): void {
    if($e->KeyCode === KeyCode::Escape) {
        $e->window->close();
    }
});
$window->setKeyRepeatEnabled(false);
//$window->setMouseCursor(\iggyvolz\SFML\Window\CursorType::CursorHand);
//$listener->subscribeTo(MouseMovedEvent::class, function(MouseMovedEvent $e): void {
//    echo "Mouse is at (" . $e->X . ", " . $e->Y . ")\n";
//});
//$listener->subscribeTo(MouseButtonPressedEvent::class, function(MouseButtonPressedEvent $e): void {
//    echo "Pressed " . $e->Button->name . "\n";
//});
//$listener->subscribeTo(MouseButtonReleasedEvent::class, function(MouseButtonReleasedEvent $e): void {
//    echo "Released " . $e->Button->name . "\n";
//});
//$listener->subscribeTo(MouseWheelScrolledEvent::class, function(MouseWheelScrolledEvent $e): void {
//    echo "Scroll " . $e->Delta . "\n";
//});
//$listener->subscribeTo(KeyPressedEvent::class, function(KeyPressedEvent $e): void {
//    echo "Pressed " . ($e->KeyCode?->name ?? "unknown key" ) . "\n";
//});
//$listener->subscribeTo(KeyReleasedEvent::class, function(KeyReleasedEvent $e): void {
//    echo "Released " . ($e->KeyCode?->name ?? "unknown key" ) . "\n";
//});
$listener->subscribeTo(JoystickConnectedEvent::class, function(JoystickConnectedEvent $e) use ($windowLib): void{
    echo "Connected joystick ID " . $e->JoystickId . "\n";
    $joystickIdentification = $windowLib->getJoystickIdentification($e->JoystickId);
    echo "You just plugged in a $joystickIdentification->name ($joystickIdentification->vendorId:$joystickIdentification->productid)\n";
    foreach (JoystickAxis::cases() as $axis) {
        if($windowLib->joystickHasAxis($e->JoystickId, $axis)) {
            echo "Has axis " . $axis->name . "\n";
        } else {
            echo "Does not have axis " . $axis->name . "\n";
        }
    }
});
EventLoop::run();
