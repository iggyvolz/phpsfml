<?php

namespace iggyvolz\SFML\System\Vector;

use FFI\CData;
use iggyvolz\SFML\System\SystemLib;

/**
 * 3-component vector of floats
 * @see System/Vector3.h
 */
class Vector3F
{
    public function __construct(
        private readonly SystemLib $systemLib,
        // sfVector3f
        /**
         * @internal
         */
        public readonly CData $cdata
    )
    {
    }

    public static function create(SystemLib $systemLib, float $x, float $y, float $z): self
    {
        $vector = $systemLib->ffi->new("sfVector3f");
        $vector->x = $x;
        $vector->y = $y;
        $vector->z = $z;
        return new self($systemLib, $vector);
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