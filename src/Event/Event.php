<?php

namespace iggyvolz\SFML\Event;

use FFI\CData;
use iggyvolz\SFML\Window\Window;

class Event
{
    // sfEventType order
    public const EVENT_CLASSES = [
        \iggyvolz\SFML\Event\ClosedEvent::class,
        \iggyvolz\SFML\Event\ResizedEvent::class,
        \iggyvolz\SFML\Event\LostFocusEvent::class,
        \iggyvolz\SFML\Event\GainedFocusEvent::class,
        \iggyvolz\SFML\Event\TextEnteredEvent::class,
        \iggyvolz\SFML\Event\KeyPressedEvent::class,
        \iggyvolz\SFML\Event\KeyReleasedEvent::class,
        \iggyvolz\SFML\Event\MouseWheelMovedEvent::class,
        \iggyvolz\SFML\Event\MouseWheelScrolledEvent::class,
        \iggyvolz\SFML\Event\MouseButtonPressedEvent::class,
        \iggyvolz\SFML\Event\MouseButtonReleasedEvent::class,
        \iggyvolz\SFML\Event\MouseMovedEvent::class,
        \iggyvolz\SFML\Event\MouseEnteredEvent::class,
        \iggyvolz\SFML\Event\MouseLeftEvent::class,
        \iggyvolz\SFML\Event\JoystickButtonPressedEvent::class,
        \iggyvolz\SFML\Event\JoystickButtonReleasedEvent::class,
        \iggyvolz\SFML\Event\JoystickMovedEvent::class,
        \iggyvolz\SFML\Event\JoystickConnectedEvent::class,
        \iggyvolz\SFML\Event\JoystickDisconnectedEvent::class,
        \iggyvolz\SFML\Event\TouchBeganEvent::class,
        \iggyvolz\SFML\Event\TouchMovedEvent::class,
        \iggyvolz\SFML\Event\TouchEndedEvent::class,
        \iggyvolz\SFML\Event\SensorChangedEvent::class,
    ];
    protected function __construct(public readonly Window $window)
    {
    }

    public static function create(Window $window, CData $cdata): self
    {
        $class = self::EVENT_CLASSES[$cdata->type];
        return new $class($window, $cdata);
    }
}