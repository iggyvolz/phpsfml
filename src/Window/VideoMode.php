<?php

namespace iggyvolz\SFML\Window;

use FFI;
use FFI\CData;

/**
 * sfVideoMode defines a video mode (width, height, bpp, frequency)
 * and provides functions for getting modes supported
 * by the display device
 */
class VideoMode
{
    public function __construct(
        private readonly WindowLib $windowLib,
        // sfVideoMode
        /** @internal  */
        public /* [almost] readonly */ CData $cdata
    )
    {
    }

    public static function create(
        WindowLib $windowLib,
        int $width,
        int $height,
        int $bitsPerPixel = 32,
    ): self {
        $self = new self($windowLib, $windowLib->ffi->new("sfVideoMode"));
        $self->setWidth($width);
        $self->setHeight($height);
        $self->setBitsPerPixel($bitsPerPixel);
        return $self;
    }

    /**
     * @return int Video mode width, in pixels
     */
    public function getWidth(): int
    {
        return $this->cdata->width;
    }

    /**
     * @param int $value Video mode width, in pixels
     * @return void
     */
    public function setWidth(int $value): void
    {
        $this->cdata->width = $value;
    }

    /**
     * @return int Video mode height, in pixels
     */
    public function getHeight(): int
    {
        return $this->cdata->height;
    }

    /**
     * @param int $value Video mode height, in pixels
     * @return void
     */
    public function setHeight(int $value): void
    {
        $this->cdata->height = $value;
    }

    /**
     * @return int Video mode pixel depth, in bits per pixels
     */
    public function getBitsPerPixel(): int
    {
        return $this->cdata->bitsPerPixel;
    }

    /**
     * @param int $value Video mode pixel depth, in bits per pixels
     * @return void
     */
    public function setBitsPerPixel(int $value): void
    {
        $this->cdata->bitsPerPixel = $value;
    }

    /**
     * Get the current desktop video mode
     * @param WindowLib $windowLib
     * @return self Current desktop video mode
     */
    public static function getDesktopMode(WindowLib $windowLib): self
    {
        return new self($windowLib, $windowLib->ffi->sfVideoMode_getDesktopMode());
    }

    /**
     * Retrieve all the video modes supported in fullscreen mode
     *
     * When creating a fullscreen window, the video mode is restricted
     * to be compatible with what the graphics driver and monitor
     * support. This function returns the complete list of all video
     * modes that can be used in fullscreen mode.
     * The returned array is sorted from best to worst, so that
     * the first element will always give the best mode (higher
     * width, height and bits-per-pixel).
     * @return list<self>
     */
    public static function getFullscreenModes(WindowLib $windowLib): array
    {
        $ret = [];
        $count = $windowLib->ffi->new("size_t");
        $modes = $windowLib->ffi->sfVideoMode_getFullscreenModes(FFI::addr($count));
        for($i = 0; $i < $count->cdata; $i++) {
            $ret[]= new self($windowLib, $modes[$i]);
        }
        return $ret;
    }

    /**
     * Tell whether or not a video mode is valid
     *
     * The validity of video modes is only relevant when using
     * fullscreen windows; otherwise any video mode can be used
     * with no restriction.
     * @return bool True if the video mode is valid for fullscreen mode
     */
    public function isValid(): bool
    {
        return $this->windowLib->ffi->sfVideoMode_isValid($this->cdata) === 1;
    }

}