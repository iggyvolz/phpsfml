<?php

namespace iggyvolz\SFML\System\Vector;

use FFI\CData;
use iggyvolz\SFML\System\SystemLib;

/**
 * 3-component vector of integers
 * @see Graphics/Glsl.h
 */
readonly class Vector3I
{
    public function __construct(
        // sfGlslIvec3
        /**
         * @internal
         */
        public CData $cdata
    )
    {
    }

    public static function create(SystemLib $systemLib, int $x, int $y, int $z): self
    {
        $vector = $systemLib->ffi->new("sfGlslIvec3");
        $vector->x = $x;
        $vector->y = $y;
        $vector->z = $z;
        return new self($vector);
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