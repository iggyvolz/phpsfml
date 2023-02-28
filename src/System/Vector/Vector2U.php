<?php

namespace iggyvolz\SFML\System\Vector;

use FFI\CData;
use iggyvolz\SFML\System\SystemLib;

/**
 * 2-component vector of unsigned integers
 * @see System/Vector2.h
 */
readonly class Vector2U
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

    public static function create(SystemLib $systemLib, int $x, int $y): self
    {
        $vector = $systemLib->ffi->new("sfVector2u");
        $vector->x = $x;
        $vector->y = $y;
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

}