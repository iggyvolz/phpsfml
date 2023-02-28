<?php

namespace iggyvolz\SFML\System\Vector;

use FFI\CData;
use iggyvolz\SFML\System\SystemLib;

/**
 * 2-component vector of floats
 * @see System/Vector2.h
 */
readonly class Vector2F
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

    public static function create(SystemLib $systemLib, float $x, float $y): self
    {
        $vector = $systemLib->ffi->new("sfVector2f");
        $vector->x = $x;
        $vector->y = $y;
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

}