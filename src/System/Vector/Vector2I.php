<?php

namespace iggyvolz\SFML\System\Vector;

use FFI\CData;
use iggyvolz\SFML\System\SystemLib;

/**
 * 2-component vector of integers
 * @see System/Vector2.h
 */
class Vector2I
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

    public static function create(SystemLib $systemLib, int $x, int $y): self
    {
        $vector = $systemLib->ffi->new("sfVector2i");
        $vector->x = $x;
        $vector->y = $y;
        return new self($systemLib, $vector);
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