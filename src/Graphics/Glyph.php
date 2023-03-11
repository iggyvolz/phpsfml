<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;

class Glyph
{
    public function __construct(
        private readonly GraphicsLib $graphicsLib,
        // sfGlyph
        public CData                 $cdata
    )
    {
    }

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
        return new FloatRect($this->graphicsLib, $this->cdata->bounds);
    }

    /**
     * @return IntRect Texture coordinates of the glyph inside the font's image
     */
    public function getTextureRect(): IntRect
    {
        return new IntRect($this->graphicsLib, $this->cdata->textureRect);
    }
}