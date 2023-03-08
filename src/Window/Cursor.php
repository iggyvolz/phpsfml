<?php

namespace iggyvolz\SFML\Window;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Utils\PixelArray;

class Cursor
{

    public function __construct(
        private readonly WindowLib $windowLib,
        // sfCursor*
        public readonly CData $cdata
    )
    {
    }

    /**
     * Create a cursor with the provided image
     *
     * In addition to specifying the pixel data, you can also
     * specify the location of the hotspot of the cursor. The
     * hotspot is the pixel coordinate within the cursor image
     * which will be located exactly where the mouse pointer
     * position is. Any mouse actions that are performed will
     * return the window/screen location of the hotspot.
     *
     * On Unix, the pixels are mapped into a monochrome
     * bitmap: pixels with an alpha channel to 0 are
     * transparent, black if the RGB channel are close
     * to zero, and white otherwise.
     *
     * @param WindowLib $windowLib
     * @param PixelArray $pixels Array of pixels of the image in 32-bit RGBA format
     * @param Vector2U $hotspot (x,y) location of the hotspot
     * @return self
     */
    public static function createFromPixels(WindowLib $windowLib, PixelArray $pixels, Vector2U $hotspot): self
    {
        return new self($windowLib, $windowLib->ffi->sfCursor_createFromPixels($pixels->CData, Vector2U::create($windowLib, $pixels->width, $pixels->height)->cdata, $hotspot->cdata));
    }

    /**
     * Create a native system cursor
     *
     * The following cursors are Windows-only:
     * - sfCursorArrowWait
     * - sfCursorSizeTopLeftBottomRight
     * - sfCursorSizeBottomLeftTopRight
     *
     * The following cursors are Windows and Linux-only:
     * - sfCursorWait
     * - sfCursorSizeAll
     * - sfCursorHelp
     *
     * @param CursorType $cursorType Type of cursor to create
     */
    public static function createFromSystem(WindowLib $windowLib, CursorType $cursorType): self
    {
        return new self($windowLib, $windowLib->ffi->sfCursor_createFromSystem($cursorType->value));
    }

    /**
     * Destroy a cursor
     */
    public function __destruct()
    {
        $this->windowLib->ffi->sfCursor_destroy($this->cdata);
    }
}