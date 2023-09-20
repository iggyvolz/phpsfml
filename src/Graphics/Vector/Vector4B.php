<?php

namespace iggyvolz\SFML\Graphics\Vector;

use iggyvolz\SFML\Graphics\GraphicsObject;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

/**
 * 4-component vector of bools
 * @see Graphics/Glsl.h
 */
#[CType("sfGlslBvec4")]
class Vector4B extends GraphicsObject
{
    public static function create(Sfml $sfml, bool $x, bool $y, bool $z, bool $w): self
    {
        $self = static::newObject($sfml);
        $self->setX($x);
        $self->setY($y);
        $self->setZ($z);
        return $self;
    }

    public function getX(): bool
    {
        return $this->cdata->x === 1;
    }
    public function setX(bool $x): void
    {
        $this->cdata->x = $x ? 1 : 0;
    }
    public function getY(): bool
    {
        return $this->cdata->y === 1;
    }
    public function setY(bool $y): void
    {
        $this->cdata->y = $y ? 1 : 0;
    }
    public function getZ(): bool
    {
        return $this->cdata->z === 1;
    }
    public function setZ(bool $z): void
    {
        $this->cdata->z = $z ? 1 : 0;
    }
    public function getW(): bool
    {
        return $this->cdata->w === 1;
    }
    public function setW(bool $w): void
    {
        $this->cdata->w = $w ? 1 : 0;
    }
}