<?php

namespace iggyvolz\SFML\System\Vector;

use FFI\CData;
use iggyvolz\SFML\System\SystemLib;

/**
 * 4-component vector of integers
 * @see Graphics/Glsl.h
 */
readonly class Vector4I
{
    public function __construct(
        // sfVector2i
        /**
         * @internal
         */
        public CData $cdata
    )
    {
    }

    public static function create(SystemLib $systemLib, int $x, int $y, int $z, int $w): self
    {
        $vector = $systemLib->ffi->new("sfGlslIvec4");
        $vector->x = $x;
        $vector->y = $y;
        $vector->z = $z;
        $vector->w = $w;
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
    public function getW(): int
    {
        return $this->cdata->w;
    }
    public function setW(int $w): void
    {
        $this->cdata->w = $w;
    }

}