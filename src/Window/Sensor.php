<?php

namespace iggyvolz\SFML\Window;

use Spem;

final class Sensor
{
    private function __construct()
    {
    }

    #[Spem("libphpsfml.so", "sensor_isAvailable")]
    public static function isAvailable(SensorType $type): bool {}

    #[Spem("libphpsfml.so", "sensor_setEnabled")]
    public static function setEnabled(SensorType $type, bool $enabled): void {}

    /**
     * @return array{0:float,1:float,2:float}
     */
    #[Spem("libphpsfml.so", "sensor_getValue")]
    public static function getPosition(SensorType $type): array {}

}