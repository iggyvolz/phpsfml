<?php

namespace iggyvolz\SFML\Graphics\Vector;

use iggyvolz\SFML\Graphics\GraphicsObject;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

/**
 * 2-component vector of bools
 * @see Graphics/Glsl.h
 */
#[CType("sfGlslBvec2")]
class Vector2B extends GraphicsObject
{
    public static function create(Sfml $sfml, bool $x, bool $y): self
    {
        $self = static::newObject($sfml);
        $self->setX($x);
        $self->setY($y);
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

}