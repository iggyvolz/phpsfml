<?php

namespace iggyvolz\SFML\Graphics\Vector;

use iggyvolz\SFML\Graphics\GraphicsObject;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

/**
 * 4-component vector of floats
 * @see Graphics/Glsl.h
 */
#[CType("sfGlslVec4")]
class Vector4F extends GraphicsObject
{
    public static function create(Sfml $sfml, float $x, float $y, float $z, float $w): self
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
    public function getW(): float
    {
        return $this->cdata->w;
    }
    public function setW(float $w): void
    {
        $this->cdata->w = $w;
    }
}