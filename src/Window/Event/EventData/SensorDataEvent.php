<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use FFI\CData;
use iggyvolz\SFML\Window\Event;
use iggyvolz\SFML\Window\SensorType;
use iggyvolz\SFML\Window\Window;

abstract class SensorDataEvent extends Event
{
    public readonly SensorType $SensorType;
    public readonly float $X;
    public readonly float $Y;
    public readonly float $Z;

    public function __construct(
        Window $window,
        // sfEvent<sfSensorEvent>
        CData $cdata
    )
    {
        parent::__construct($window);
        $this->SensorType = SensorType::from($cdata->sensor->sensorType);
        $this->X = $cdata->sensor->x;
        $this->Y = $cdata->sensor->y;
        $this->Z = $cdata->sensor->z;
    }
}