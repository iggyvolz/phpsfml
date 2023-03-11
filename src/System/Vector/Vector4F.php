<?php

namespace iggyvolz\SFML\System\Vector;

use FFI\CData;
use iggyvolz\SFML\System\SystemLib;

/**
 * 4-component vector of floats
 * @see Graphics/Glsl.h
 */
readonly class Vector4F
{
    public function __construct(
        // sfGlslVec4
        /**
         * @internal
         */
        public CData $cdata
    )
    {
    }

    public static function create(SystemLib $systemLib, float $x, float $y, float $z, float $w): self
    {
        $vector = $systemLib->ffi->new("sfGlslVec4");
        $vector->x = $x;
        $vector->y = $y;
        $vector->z = $z;
        $vector->w = $w;
        return new self($vector);
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