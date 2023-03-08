<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;

class FontInfo
{
    public function __construct(
        // sfFontInfo
        public CData $cdata
    )
    {
    }
    public function getFamily(): string
    {
        return $this->cdata->family;
    }
}