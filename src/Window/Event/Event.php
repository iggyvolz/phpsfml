<?php

namespace iggyvolz\SFML\Window\Event;

use FFI\CData;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\SystemObject;
use iggyvolz\SFML\Utils\CType;

#[CType("int")] // horrible hack but it works do not ask
abstract class Event extends SystemObject
{
    // sfEventType order
    public const EVENT_CLASSES = [
        ClosedEvent::class,
        ResizedEvent::class,
        LostFocusEvent::class,
        GainedFocusEvent::class,
        TextEnteredEvent::class,
        KeyPressedEvent::class,
        KeyReleasedEvent::class,
        MouseWheelMovedEvent::class,
        MouseWheelScrolledEvent::class,
        MouseButtonPressedEvent::class,
        MouseButtonReleasedEvent::class,
        MouseMovedEvent::class,
        MouseEnteredEvent::class,
        MouseLeftEvent::class,
        JoystickButtonPressedEvent::class,
        JoystickButtonReleasedEvent::class,
        JoystickMovedEvent::class,
        JoystickConnectedEvent::class,
        JoystickDisconnectedEvent::class,
        TouchBeganEvent::class,
        TouchMovedEvent::class,
        TouchEndedEvent::class,
        SensorChangedEvent::class,
    ];

    public static function create(Sfml $sfml, CData $cdata, bool $external): self
    {
        $class = self::EVENT_CLASSES[$cdata->type];
        return new $class($sfml, $cdata, $external);
    }
}