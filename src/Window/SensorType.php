<?php

namespace iggyvolz\SFML\Window;

enum SensorType: int
{
    /**
     * Measures the raw acceleration (m/s^2)
     */
    case SensorAccelerometer = 0;
    /**
     * Measures the raw rotation rates (degrees/s)
     */
    case SensorGyroscope = 1;
    /**
     * Measures the ambient magnetic field (micro-teslas)
     */
    case SensorMagnetometer = 2;
    /**
     * Measures the direction and intensity of gravity, independent of device acceleration (m/s^2)
     */
    case SensorGravity = 3;
    /**
     * Measures the direction and intensity of device acceleration, independent of the gravity (m/s^2)
     */
    case SensorUserAcceleration = 4;
    /**
     * Measures the absolute 3D orientation (degrees)
     */
    case SensorOrientation = 5;
}
