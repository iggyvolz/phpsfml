<?php

namespace iggyvolz\SFML\Window;

/**
 * sfVideoMode defines a video mode (width, height, bpp, frequency)
 * and provides functions for getting modes supported
 * by the display device
 */
class VideoMode
{
    #[\Spem("videomode_construct")]
    public function __construct(
        int $width,
        int $height,
        int $bitsPerPixel = 32,
    ) {}

    public int $width { #[\Spem("videomode_getwidth")] get {} #[\Spem("videomode_setwidth")] set {}}
    public int $height { #[\Spem("videomode_getheight")] get {} #[\Spem("videomode_setheight")] set {}}
    public int $bitsPerPixel { #[\Spem("videomode_getbitsperpixel")] get {} #[\Spem("videomode_setbitsperpixel")] set {}}

    public bool $isValid { #[\Spem("videomode_isvalid")] get {}}
    #[\Spem("videomode_destruct")]
    public function __destruct()
    {
    }

}