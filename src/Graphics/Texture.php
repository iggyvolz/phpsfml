<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;

class Texture
{
    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfTexture*
        public CData $cdata
    )
    {
    }
}