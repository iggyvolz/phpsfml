<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Utils\CType;

#[CType("sfFontInfo")]
class FontInfo extends GraphicsObject
{
    public function getFamily(): string
    {
        return $this->cdata->family;
    }
    public function setFamily(string $family): void
    {
        $this->cdata->family = $family;
    }
}