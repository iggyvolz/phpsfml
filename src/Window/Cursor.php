<?php

namespace iggyvolz\SFML\Window;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Utils\CType;
use iggyvolz\SFML\Utils\PixelArray;
#[CType("sfCursor*")]
class Cursor extends WindowObject
{

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
     * @param PixelArray $pixels Array of pixels of the image in 32-bit RGBA format
     * @param Vector2U $hotspot (x,y) location of the hotspot
     * @return self
     */
    public static function createFromPixels(Sfml $sfml, PixelArray $pixels, Vector2U $hotspot): self
    {
        return new self($sfml, $sfml->window->ffi->sfCursor_createFromPixels($pixels->cdata, Vector2U::create($sfml, $pixels->width, $pixels->height)->asWindow(), $hotspot->asWindow()));
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
    public static function createFromSystem(Sfml $sfml, CursorType $cursorType): self
    {
        return new self($sfml, $sfml->window->ffi->sfCursor_createFromSystem($cursorType->value));
    }

    /**
     * Destroy a cursor
     */
    public function __destruct()
    {
        $this->sfml->window->ffi->sfCursor_destroy($this->cdata);
    }
}