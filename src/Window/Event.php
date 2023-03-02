<?php

namespace iggyvolz\SFML\Window;

use FFI\CData;

class Event
{
    // sfEventType order
    public const EVENT_CLASSES = [
        Event\ClosedEvent::class,
        Event\ResizedEvent::class,
        Event\LostFocusEvent::class,
        Event\GainedFocusEvent::class,
        Event\TextEnteredEvent::class,
        Event\KeyPressedEvent::class,
        Event\KeyReleasedEvent::class,
        Event\MouseWheelMovedEvent::class,
        Event\MouseWheelScrolledEvent::class,
        Event\MouseButtonPressedEvent::class,
        Event\MouseButtonReleasedEvent::class,
        Event\MouseMovedEvent::class,
        Event\MouseEnteredEvent::class,
        Event\MouseLeftEvent::class,
        Event\JoystickButtonPressedEvent::class,
        Event\JoystickButtonReleasedEvent::class,
        Event\JoystickMovedEvent::class,
        Event\JoystickConnectedEvent::class,
        Event\JoystickDisconnectedEvent::class,
        Event\TouchBeganEvent::class,
        Event\TouchMovedEvent::class,
        Event\TouchEndedEvent::class,
        Event\SensorChangedEvent::class,
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