<?php

namespace iggyvolz\SFML\System\Vector;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\SystemObject;
use iggyvolz\SFML\Utils\CType;

/**
 * 2-component vector of unsigned integers
 * @see System/Vector2.h
 */
#[CType("sfVector2u")]
class Vector2U extends SystemObject
{
    public static function create(Sfml $sfml, int $x, int $y): self
    {
        $self = static::newObject($sfml);
        $self->setX($x);
        $self->setY($y);
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

}