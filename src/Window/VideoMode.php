<?php

namespace iggyvolz\SFML\Window;

use FFI;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

/**
 * sfVideoMode defines a video mode (width, height, bpp, frequency)
 * and provides functions for getting modes supported
 * by the display device
 */
#[CType("sfVideoMode")]
class VideoMode extends WindowObject
{
    public static function create(
        Sfml $sfml,
        int $width,
        int $height,
        int $bitsPerPixel = 32,
    ): self {
        $self = static::newObject($sfml);
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
     * @return self Current desktop video mode
     */
    public static function getDesktopMode(Sfml $sfml): self
    {
        return new self($sfml, $sfml->window->ffi->sfVideoMode_getDesktopMode());
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
    public static function getFullscreenModes(Sfml $sfml): array
    {
        $ret = [];
        $count = $sfml->window->ffi->new("size_t");
        $modes = $sfml->window->ffi->sfVideoMode_getFullscreenModes(FFI::addr($count));
        for($i = 0; $i < $count->cdata; $i++) {
            $ret[]= new self($sfml, $modes[$i]);
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
        return $this->sfml->window->ffi->sfVideoMode_isValid($this->cdata) === 1;
    }

}