<?php

namespace iggyvolz\SFML\System\Vector;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\SystemObject;
use iggyvolz\SFML\Utils\CType;

/**
 * 2-component vector of floats
 * @see System/Vector2.h
 */
#[CType("sfVector2f")]
class Vector2F extends SystemObject
{
    public static function create(Sfml $sfml, float $x, float $y): self
    {
        $self = static::newObject($sfml);
        $self->setX($x);
        $self->setY($y);
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

}