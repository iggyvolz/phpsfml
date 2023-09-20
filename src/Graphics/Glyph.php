<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Utils\CType;

#[CType("sfGlyph")]
class Glyph extends GraphicsObject
{
    /**
     * @return float Offset to move horizontically to the next character
     */
    public function getAdvance(): float
    {
        return $this->cdata->advance;
    }
    /**
     *  Bounding rectangle of the glyph, in coordinates relative to the baseline
     */
    public function getBounds(): FloatRect
    {
        return new FloatRect($this->sfml, $this->cdata->bounds);
    }

    /**
     * @return IntRect Texture coordinates of the glyph inside the font's image
     */
    public function getTextureRect(): IntRect
    {
        return new IntRect($this->sfml, $this->cdata->textureRect);
    }
}