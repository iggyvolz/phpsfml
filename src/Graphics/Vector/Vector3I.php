<?php

namespace iggyvolz\SFML\Graphics\Vector;

use iggyvolz\SFML\Graphics\GraphicsObject;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

/**
 * 3-component vector of integers
 * @see Graphics/Glsl.h
 */
#[CType("sfGlslIvec3")]
class Vector3I extends GraphicsObject
{
    public static function create(Sfml $sfml, int $x, int $y, int $z): self
    {
        $self = static::newObject($sfml);
        $self->setX($x);
        $self->setY($y);
        $self->setZ($z);
        return $self;
    }

    public function getX(): int
    {
        return $this->cdata->x;
    }
    public function setX(int $x): void
    {
        $this->cdata->x = $x;
    }
    public function getY(): int
    {
        return $this->cdata->y;
    }
    public function setY(int $y): void
    {
        $this->cdata->y = $y;
    }
    public function getZ(): int
    {
        return $this->cdata->z;
    }
    public function setZ(int $z): void
    {
        $this->cdata->z = $z;
    }

}