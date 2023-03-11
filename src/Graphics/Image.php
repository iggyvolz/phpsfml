<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use FFI\CData;
use iggyvolz\SFML\System\InputStream;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Utils\PixelArray;

class Image
{
    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfImage*
        /** @internal  */
        private CData $cdata
    )
    {
    }
    public static function create(
        GraphicsLib $graphicsLib,
        int $width,
        int $height,
    ): ?self
    {
        $cdata = $graphicsLib->ffi->sfImage_create($width, $height);
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }
    public static function createFromColor(
        GraphicsLib $graphicsLib,
        int $width,
        int $height,
        Color $color
    ): ?self
    {
        $cdata = $graphicsLib->ffi->sfImage_createFromColor($width, $height, $color->cdata);
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }
    public static function createFromPixels(
        GraphicsLib $graphicsLib,
        PixelArray $pixels
    ): ?self
    {
        $cdata = $graphicsLib->ffi->sfImage_createFromPixels($pixels->width, $pixels->height, $pixels->cdata);
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }
    public static function createFromFile(
        GraphicsLib $graphicsLib,
        string $filename
    ): ?self
    {
        $cdata = $graphicsLib->ffi->sfImage_createFromFile($filename);
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }
    public static function createFromMemory(
        GraphicsLib $graphicsLib,
        string $data
    ): ?self
    {
        $len = strlen($data);
        $dataPtr = FFI::new("char[$len]");
        FFI::memcpy($dataPtr, $data, $len);
        $cdata = $graphicsLib->ffi->sfImage_createFromMemory(FFI::cast("void*", FFI::addr($dataPtr)), $len);
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }
    public static function createFromStream(
        GraphicsLib $graphicsLib,
        InputStream $stream,
    ): ?self
    {
        $cdata = $graphicsLib->ffi->createFromStream($stream->cdata);
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }

    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfImage_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfImage_destroy($this->cdata);
    }

    public function saveToFile(string $filename): bool
    {
        return $this->graphicsLib->ffi->sfImage_saveToFile($this->cdata, $filename) === 1;
    }

    public function getSize(): Vector2U
    {
        return new Vector2U($this->graphicsLib->ffi->sfImage_getSize($this->cdata));
    }

    public function createMaskFromColor(Color $color, int $alpha): void
    {
        $this->graphicsLib->ffi->sfImage_createMaskFromColor($this->cdata, $color->cdata, $alpha);
    }

    public function copyImage(Image $source, int $destX, int $destY, IntRect $sourceRect, bool $applyAlpha): void
    {
        $this->graphicsLib->ffi->sfImage_copyImage($this->cdata, $source->cdata, $destX, $destY, $sourceRect->cdata, $applyAlpha ? 1 : 0);
    }

    public function setPixel(int $x, int $y, Color $color): void
    {
        $this->graphicsLib->ffi->sfImage_setPixel($this->cdata, $x, $y, $color->cdata);
    }

    public function getPixel(int $x, int $y): Color
    {
        return new Color($this->graphicsLib, $this->graphicsLib->ffi->sfImage_getPixel($this->cdata, $x, $y));
    }

    public function getPixels(): ?PixelArray
    {
        $pixels = $this->graphicsLib->ffi->sfImage_getPixelsPtr($this->cdata);
        if(is_null($pixels)) {
            return null;
        }
        $size = $this->getSize();
        return new PixelArray($pixels, $size->getX(), $size->getY());
    }

    public function flipHorizontally(): void
    {
        $this->graphicsLib->ffi->sfImage_flipHorizontally($this->cdata);
    }

    public function flipVertically(): void
    {
        $this->graphicsLib->ffi->sfImage_flipVertically($this->cdata);
    }

}