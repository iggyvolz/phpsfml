<?php

namespace iggyvolz\SFML\System\Vector;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\SystemObject;
use iggyvolz\SFML\Utils\CType;

/**
 * 3-component vector of floats
 * @see System/Vector3.h
 */
#[CType("sfVector3f")]
class Vector3F extends SystemObject
{
    public static function create(Sfml $sfml, float $x, float $y, float $z): self
    {
        $self = static::newObject($sfml);
        $self->setX($x);
        $self->setY($y);
        $self->setZ($z);
        return $self;
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