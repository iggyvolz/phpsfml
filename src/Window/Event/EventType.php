<?php

namespace iggyvolz\SFML\Window\Event;

enum EventType: int
{
    /**
     * The window requested to be closed
     */
    case Closed = 0;
    /**
     * The window was resized
     */
    case Resized = 1;
    /**
     * The window lost the focus
     */
    case LostFocus = 2;
    /**
     * The window gained the focus
     */
    case GainedFocus = 3;
    /**
     * A character was entered
     */
    case TextEntered = 4;
    /**
     * A key was pressed
     */
    case KeyPressed = 5;
    /**
     * A key was released
     */
    case KeyReleased = 6;
    /**
     * The mouse wheel was scrolled
     */
    case MouseWheelMoved = 7;
    /**
     * The mouse wheel was scrolled
     */
    case MouseWheelScrolled = 8;
    /**
     * A mouse button was pressed
     */
    case MouseButtonPressed = 9;
    /**
     * A mouse button was released
     */
    case MouseButtonReleased = 10;
    /**
     * The mouse cursor moved
     */
    case MouseMoved = 11;
    /**
     * The mouse cursor entered the area of the window
     */
    case MouseEntered = 12;
    /**
     * The mouse cursor left the area of the window
     */
    case MouseLeft = 13;
    /**
     * A joystick button was pressed
     */
    case JoystickButtonPressed = 14;
    /**
     * A joystick button was released
     */
    case JoystickButtonReleased = 15;
    /**
     * The joystick moved along an axis
     */
    case JoystickMoved = 16;
    /**
     * A joystick was connected
     */
    case JoystickConnected = 17;
    /**
     * A joystick was disconnected
     */
    case JoystickDisconnected = 18;
    /**
     * A touch event began
     */
    case TouchBegan = 19;
    /**
     * A touch moved
     */
    case TouchMoved = 20;
    /**
     * A touch event ended
     */
    case TouchEnded = 21;
    /**
     * A sensor value changed
     */
    case SensorChanged = 22;
}
