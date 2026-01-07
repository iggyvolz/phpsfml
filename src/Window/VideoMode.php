<?php

namespace iggyvolz\SFML\Window;

/**
 * sfVideoMode defines a video mode (width, height, bpp, frequency)
 * and provides functions for getting modes supported
 * by the display device
 */
class VideoMode
{
    #[\Spem("libphpsfml.so", "videomode_construct")]
    public function __construct(
        int $width,
        int $height,
        int $bitsPerPixel = 32,
    ) {}

    public int $width { #[\Spem("libphpsfml.so", "videomode_getwidth")] get {} #[\Spem("libphpsfml.so", "videomode_setwidth")] set {}}
    public int $height { #[\Spem("libphpsfml.so", "videomode_getheight")] get {} #[\Spem("libphpsfml.so", "videomode_setheight")] set {}}
    public int $bitsPerPixel { #[\Spem("libphpsfml.so", "videomode_getbitsperpixel")] get {} #[\Spem("libphpsfml.so", "videomode_setbitsperpixel")] set {}}

    public bool $isValid { #[\Spem("libphpsfml.so", "videomode_isvalid")] get {}}
    #[\Spem("libphpsfml.so", "videomode_destruct")]
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

}