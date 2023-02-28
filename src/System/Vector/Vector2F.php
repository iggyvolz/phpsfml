<?php

namespace iggyvolz\SFML\System\Vector;

use FFI\CData;
use iggyvolz\SFML\System\SystemLib;

/**
 * 2-component vector of floats
 * @see System/Vector2.h
 */
class Vector2F
{
    public function __construct(
        private readonly SystemLib $systemLib,
        // sfVector2i
        /**
         * @internal
         */
        public readonly CData $cdata
    )
    {
    }

    public static function create(SystemLib $systemLib, float $x, float $y): self
    {
        $vector = $systemLib->ffi->new("sfVector2f");
        $vector->x = $x;
        $vector->y = $y;
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

}