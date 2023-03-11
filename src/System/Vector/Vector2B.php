<?php

namespace iggyvolz\SFML\System\Vector;

use FFI\CData;
use iggyvolz\SFML\Graphics\GraphicsLib;
use iggyvolz\SFML\System\SystemLib;

/**
 * 2-component vector of bools
 * @see Graphics/Glsl.h
 */
readonly class Vector2B
{
    public function __construct(
        // sfGlslBvec2
        /**
         * @internal
         */
        public CData $cdata
    )
    {
    }

    public static function create(GraphicsLib $graphicsLib, bool $x, bool $y): self
    {
        $vector = $graphicsLib->ffi->new("sfGlslBvec2");
        $vector->x = $x ? 1 : 0;
        $vector->y = $y ? 1 : 0;
        return new self($vector);
    }

    public function getX(): bool
    {
        return $this->cdata->x === 1;
    }
    public function setX(bool $x): void
    {
        $this->cdata->x = $x ? 1 : 0;
    }
    public function getY(): bool
    {
        return $this->cdata->y === 1;
    }
    public function setY(bool $y): void
    {
        $this->cdata->y = $y ? 1 : 0;
    }

}