<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\InputStream;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Utils\CType;
use iggyvolz\SFML\Utils\PixelArray;
#[CType("sfImage*")]
class Image extends GraphicsObject
{
    public static function create(
        Sfml $sfml,
        int $width,
        int $height,
    ): ?self
    {
        $cdata = $sfml->graphics->ffi->sfImage_create($width, $height);
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }
    public static function createFromColor(
        Sfml $sfml,
        int $width,
        int $height,
        Color $color
    ): ?self
    {
        $cdata = $sfml->graphics->ffi->sfImage_createFromColor($width, $height, $color->asGraphics());
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }
    public static function createFromPixels(
        Sfml $sfml,
        PixelArray $pixels
    ): ?self
    {
        $cdata = $sfml->graphics->ffi->sfImage_createFromPixels($pixels->width, $pixels->height, $pixels->cdata);
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }
    public static function createFromFile(
        Sfml $sfml,
        string $filename
    ): ?self
    {
        $cdata = $sfml->graphics->ffi->sfImage_createFromFile($filename);
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }
    public static function createFromMemory(
        Sfml $sfml,
        string $data
    ): ?self
    {
        $len = strlen($data);
        $dataPtr = FFI::new("char[$len]");
        FFI::memcpy($dataPtr, $data, $len);
        $cdata = $sfml->graphics->ffi->sfImage_createFromMemory(FFI::cast("void*", FFI::addr($dataPtr)), $len);
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }
    public static function createFromStream(
        Sfml $sfml,
        InputStream $stream,
    ): ?self
    {
        $cdata = $sfml->graphics->ffi->sfImage_createFromStream($stream->asGraphics());
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }

    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfImage_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfImage_destroy($this->cdata);
    }

    public function saveToFile(string $filename): bool
    {
        return $this->sfml->graphics->ffi->sfImage_saveToFile($this->cdata, $filename) === 1;
    }

    public function getSize(): Vector2U
    {
        return new Vector2U($this->sfml, $this->sfml->graphics->ffi->sfImage_getSize($this->cdata), true);
    }

    public function createMaskFromColor(Color $color, int $alpha): void
    {
        $this->sfml->graphics->ffi->sfImage_createMaskFromColor($this->cdata, $color->asGraphics(), $alpha);
    }

    public function copyImage(Image $source, int $destX, int $destY, IntRect $sourceRect, bool $applyAlpha): void
    {
        $this->sfml->graphics->ffi->sfImage_copyImage($this->cdata, $source->asGraphics(), $destX, $destY, $sourceRect->asGraphics(), $applyAlpha ? 1 : 0);
    }

    public function setPixel(int $x, int $y, Color $color): void
    {
        $this->sfml->graphics->ffi->sfImage_setPixel($this->cdata, $x, $y, $color->asGraphics());
    }

    public function getPixel(int $x, int $y): Color
    {
        return new Color($this->sfml, $this->sfml->graphics->ffi->sfImage_getPixel($this->cdata, $x, $y));
    }

    public function getPixels(): ?PixelArray
    {
        $pixels = $this->sfml->graphics->ffi->sfImage_getPixelsPtr($this->cdata);
        if(is_null($pixels)) {
            return null;
        }
        $size = $this->getSize();
        return new PixelArray($pixels, $size->getX(), $size->getY());
    }

    public function flipHorizontally(): void
    {
        $this->sfml->graphics->ffi->sfImage_flipHorizontally($this->cdata);
    }

    public function flipVertically(): void
    {
        $this->sfml->graphics->ffi->sfImage_flipVertically($this->cdata);
    }

}