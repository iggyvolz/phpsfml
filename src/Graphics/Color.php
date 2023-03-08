<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;

/**
 * Utility class for manpulating RGBA colors
 */
readonly class Color
{

    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfColor
        public CData $cdata
    )
    {
    }
    public function getR(): int
    {
        return $this->cdata->r;
    }
    public function getG(): int
    {
        return $this->cdata->r;
    }
    public function getB(): int
    {
        return $this->cdata->b;
    }
    public function getA(): int
    {
        return $this->cdata->a;
    }

    /**
     * Construct a color from its 3 RGB components
     * @param GraphicsLib $graphicsLib
     * @param int $red Red component (0 .. 255)
     * @param int $green Green component (0 .. 255)
     * @param int $blue Blue component (0 .. 255)
     * @return self Color constructed from the components
     */
    public static function createFromRGB(
        GraphicsLib $graphicsLib,
        int $red,
        int $green,
        int $blue,
    ): self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfColor_fromRGB($red, $green, $blue));
    }

    /**
     * Construct a color from its 4 RGBA components
     * @param GraphicsLib $graphicsLib
     * @param int $red Red component (0 .. 255)
     * @param int $green Green component (0 .. 255)
     * @param int $blue Blue component (0 .. 255)
     * @param int $alpha Alpha component (0 .. 255)
     * @return self Color constructed from the components
     */
    public static function createFromRGBA(
        GraphicsLib $graphicsLib,
        int $red,
        int $green,
        int $blue,
        int $alpha,
    ): self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfColor_fromRGBA($red, $green, $blue, $alpha));
    }

    /**
     * Convert a color to a 32-bit unsigned integer
     * @return int Color represented as a 32-bit unsigned integer
     */
    public function convertToInteger(): int
    {
        return $this->graphicsLib->ffi->sfColor_toInteger($this->cdata);
    }

    /**
     * Add two colors
     * @return Color Component-wise saturated addition of the two colors
     */
    public function add(Color $color2): Color
    {
        return new self($this->graphicsLib, $this->graphicsLib->ffi->sfColor_add($this->cdata, $color2->cdata));
    }

    /**
     * Subtract two colors
     * @return Color Component-wise saturated subtraction of the two colors
     */
    public function subtract(Color $color2): Color
    {
        return new self($this->graphicsLib, $this->graphicsLib->ffi->sfColor_subtract($this->cdata, $color2->cdata));
    }

    /**
     * Modulate two colors
     * @return Color Component-wise multiplication of the two colors
     */
    public function modulate(Color $color2): Color
    {
        return new self($this->graphicsLib, $this->graphicsLib->ffi->sfColor_modulate($this->cdata, $color2->cdata));
    }
}