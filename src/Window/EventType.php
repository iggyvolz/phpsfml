<?php

namespace iggyvolz\SFML\Window;

enum EventType: int
{
    /**
     * The window requested to be closed
     */
    case sfEvtClosed = 0;
    /**
     * The window was resized
     */
    case sfEvtResized = 1;
    /**
     * The window lost the focus
     */
    case sfEvtLostFocus = 2;
    /**
     * The window gained the focus
     */
    case sfEvtGainedFocus = 3;
    /**
     * A character was entered
     */
    case sfEvtTextEntered = 4;
    /**
     * A key was pressed
     */
    case sfEvtKeyPressed = 5;
    /**
     * A key was released
     */
    case sfEvtKeyReleased = 6;
    /**
     * The mouse wheel was scrolled
     */
    case sfEvtMouseWheelMoved = 7;
    /**
     * The mouse wheel was scrolled
     */
    case sfEvtMouseWheelScrolled = 8;
    /**
     * A mouse button was pressed
     */
    case sfEvtMouseButtonPressed = 9;
    /**
     * A mouse button was released
     */
    case sfEvtMouseButtonReleased = 10;
    /**
     * The mouse cursor moved
     */
    case sfEvtMouseMoved = 11;
    /**
     * The mouse cursor entered the area of the window
     */
    case sfEvtMouseEntered = 12;
    /**
     * The mouse cursor left the area of the window
     */
    case sfEvtMouseLeft = 13;
    /**
     * A joystick button was pressed
     */
    case sfEvtJoystickButtonPressed = 14;
    /**
     * A joystick button was released
     */
    case sfEvtJoystickButtonReleased = 15;
    /**
     * The joystick moved along an axis
     */
    case sfEvtJoystickMoved = 16;
    /**
     * A joystick was connected
     */
    case sfEvtJoystickConnected = 17;
    /**
     * A joystick was disconnected
     */
    case sfEvtJoystickDisconnected = 18;
    /**
     * A touch event began
     */
    case sfEvtTouchBegan = 19;
    /**
     * A touch moved
     */
    case sfEvtTouchMoved = 20;
    /**
     * A touch event ended
     */
    case sfEvtTouchEnded = 21;
    /**
     * A sensor value changed
     */
    case sfEvtSensorChanged = 22;
}
