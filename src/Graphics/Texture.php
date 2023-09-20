<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\InputStream;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Utils\CType;
use iggyvolz\SFML\Utils\PixelArray;
use iggyvolz\SFML\Window\Window;

#[CType("sfTexture*")]
class Texture extends GraphicsObject
{
    public static function create(Sfml $sfml, int $width, int $height): ?self
    {
        $cdata = $sfml->graphics->ffi->sfTexture_create($width, $height);
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }

    public static function createFromFile(Sfml $sfml, string $filename, ?IntRect $area = null, bool $srgb = false): ?self
    {
        $cdata = $srgb ? $sfml->graphics->ffi->sfTexture_createSrgbFromFile($filename, $area?->asGraphics()) : $sfml->graphics->ffi->sfTexture_createFromFile($filename, $area?->asGraphics());
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }

    public static function createFromMemory(Sfml $sfml, string $data, ?IntRect $area = null, bool $srgb = false): ?self
    {
        $len = strlen($data);
        $dataPtr = $sfml->graphics->ffi->new("char[$len]");
        FFI::memcpy($dataPtr, $data, $len);

        $cdata = $srgb ? $sfml->graphics->ffi->sfTexture_createSrgbFromMemory($dataPtr, $len, $area?->asGraphics()) : $sfml->graphics->ffi->sfTexture_createFromMemory($dataPtr, $len, $area?->asGraphics());
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }

    public static function createFromStream(Sfml $sfml, InputStream $stream, ?IntRect $area = null, bool $srgb = false): ?self
    {
        $cdata = $srgb ? $sfml->graphics->ffi->sfTexture_createFromStream($stream->asGraphics(), $area?->asGraphics()) : $sfml->graphics->ffi->sfTexture_createSrgbFromStream($stream->asGraphics(), $area?->asGraphics());
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }

    public static function createFromImage(Sfml $sfml, Image $image, ?IntRect $area = null, bool $srgb = false): ?self
    {
        $cdata = $srgb ? $sfml->graphics->ffi->sfTexture_createFromImage($image->asGraphics(), $area?->asGraphics()) : $sfml->graphics->ffi->sfTexture_createSrgbFromImage($image->asGraphics(), $area?->asGraphics());
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }

    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfTexture_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfTexture_destroy($this->cdata);
    }

    public function getSize(): Vector2U
    {
        return new Vector2U($this->sfml, $this->sfml->graphics->ffi->sfTexture_getSize($this->cdata), true);
    }

    public function copyToImage(): Image
    {
        return new Image($this->sfml, $this->sfml->graphics->ffi->sfTexture_copyToImage($this->cdata));
    }

    public function updateFromPixels(PixelArray $pixels, int $x, int $y): void
    {
        $this->sfml->graphics->ffi->sfTexture_updateFromPixels($this->cdata, $pixels->cdata, $pixels->width, $pixels->height, $x, $y);
    }

    public function updateFromTexture(Texture $source, int $x, int $y): void
    {
        $this->sfml->graphics->ffi->sfTexture_updateFromTexture($this->cdata, $source->asGraphics(), $x, $y);
    }

    public function updateFromImage(Image $source, int $x, int $y): void
    {
        $this->sfml->graphics->ffi->sfTexture_updateFromTexture($this->cdata, $source->asGraphics(), $x, $y);
    }

    public function updateFromWindow(Window $source, int $x, int $y): void
    {
        if ($source instanceof RenderWindow) {
            $this->sfml->graphics->ffi->sfTexture_updateFromRenderWindow($this->cdata, $source->asGraphics(), $x, $y);
        } else {
            $this->sfml->graphics->ffi->sfTexture_updateFromWindow($this->cdata, $source->asGraphics(), $x, $y);
        }
    }

    public function setSmooth(bool $smooth): void
    {
        $this->sfml->graphics->ffi->sfTexture_setSmooth($this->cdata, $smooth ? 1 : 0);
    }

    public function isSmooth(): bool
    {
        return $this->sfml->graphics->ffi->sfTexture_isSmooth($this->cdata) === 1;
    }

    public function isSrgb(): bool
    {
        return $this->sfml->graphics->ffi->sfTexture_isSrgb($this->cdata) === 1;
    }

    public function setRepeated(bool $repeated): void
    {
        $this->sfml->graphics->ffi->sfTexture_setRepeated($this->cdata, $repeated ? 1 : 0);
    }

    public function isRepeated(): bool
    {
        return $this->sfml->graphics->ffi->sfTexture_isRepeated($this->cdata) === 1;
    }

    public function generateMipmap(): void
    {
        $this->sfml->graphics->ffi->sfTexture_generateMipmap($this->cdata);
    }

    public function swap(Texture $other): void
    {
        $this->sfml->graphics->ffi->sfTexture_swap($this->cdata, $other->asGraphics());
    }

    public function getNativeHandle(): int
    {
        return $this->sfml->graphics->ffi->sfTexture_getNativeHandle($this->cdata);
    }

    public function bind(): void
    {
        $this->sfml->graphics->ffi->sfTexture_bind($this->cdata);
    }

    public static function unbind(Sfml $sfml): void
    {
        $sfml->graphics->ffi->sfTexture_bind(null);
    }

    public function getMaximumSize(): int
    {
        return $this->sfml->graphics->ffi->sfTexture_getMaximumSize($this->cdata);
    }
}