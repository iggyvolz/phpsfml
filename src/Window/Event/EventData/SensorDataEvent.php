<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;
use iggyvolz\SFML\Window\SensorType;

abstract class SensorDataEvent extends Event
{
    public function getSensorType(): SensorType
    {
        return SensorType::from($this->cdata->sensorType);
    }
    public function setSensorType(SensorType $sensorType): void
    {
        $this->cdata->sensorType = $sensorType->value;
    }
    public function getX(): float
    {
        return $this->cdata->x;
    }
    public function setX(float $x): void
    {
        $this->cdata->x = $x;
    }
    public function getY(): float
    {
        return $this->cdata->y;
    }
    public function setY(float $y): void
    {
        $this->cdata->y = $y;
    }
    public function getZ(): float
    {
        return $this->cdata->z;
    }
    public function setZ(float $z): void
    {
        $this->cdata->z = $z;
    }
}