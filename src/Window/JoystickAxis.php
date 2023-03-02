<?php

namespace iggyvolz\SFML\Window;

enum JoystickAxis: int
{
    /**
     * The X axis
     */
    case JoystickX = 0;
    /**
     * The Y axis
     */
    case JoystickY = 1;
    /**
     * The Z axis
     */
    case JoystickZ = 2;
    /**
     * The R axis
     */
    case JoystickR = 3;
    /**
     * The U axis
     */
    case JoystickU = 4;
    /**
     * The V axis
     */
    case JoystickV = 5;
    /**
     * The X axis of the point-of-view hat
     */
    case JoystickPovX = 6;
    /**
     * The Y axis of the point-of-view hat
     */
    case JoystickPovY = 7;
}
