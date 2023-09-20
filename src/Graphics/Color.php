<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

/**
 * Utility class for manipulating RGBA colors
 */
#[CType("sfColor")]
class Color extends GraphicsObject
{
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
     * @param int $red Red component (0 .. 255)
     * @param int $green Green component (0 .. 255)
     * @param int $blue Blue component (0 .. 255)
     * @return self Color constructed from the components
     */
    public static function createFromRGB(
        Sfml $sfml,
        int $red,
        int $green,
        int $blue,
    ): self
    {
        return new self($sfml, $sfml->graphics->ffi->sfColor_fromRGB($red, $green, $blue));
    }

    /**
     * Construct a color from its 4 RGBA components
     * @param int $red Red component (0 .. 255)
     * @param int $green Green component (0 .. 255)
     * @param int $blue Blue component (0 .. 255)
     * @param int $alpha Alpha component (0 .. 255)
     * @return self Color constructed from the components
     */
    public static function createFromRGBA(
        Sfml $sfml,
        int $red,
        int $green,
        int $blue,
        int $alpha,
    ): self
    {
        return new self($sfml, $sfml->graphics->ffi->sfColor_fromRGBA($red, $green, $blue, $alpha));
    }

    /**
     * Convert a color to a 32-bit unsigned integer
     * @return int Color represented as a 32-bit unsigned integer
     */
    public function convertToInteger(): int
    {
        return $this->sfml->graphics->ffi->sfColor_toInteger($this->cdata);
    }

    /**
     * Add two colors
     * @return Color Component-wise saturated addition of the two colors
     */
    public function add(Color $color2): Color
    {
        return new self($this->sfml, $this->sfml->graphics->ffi->sfColor_add($this->cdata, $color2->asGraphics()));
    }

    /**
     * Subtract two colors
     * @return Color Component-wise saturated subtraction of the two colors
     */
    public function subtract(Color $color2): Color
    {
        return new self($this->sfml, $this->sfml->graphics->ffi->sfColor_subtract($this->cdata, $color2->asGraphics()));
    }

    /**
     * Modulate two colors
     * @return Color Component-wise multiplication of the two colors
     */
    public function modulate(Color $color2): Color
    {
        return new self($this->sfml, $this->sfml->graphics->ffi->sfColor_modulate($this->cdata, $color2->asGraphics()));
    }
}