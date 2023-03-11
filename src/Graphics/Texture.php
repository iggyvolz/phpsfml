<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use FFI\CData;
use iggyvolz\SFML\System\InputStream;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Utils\PixelArray;
use iggyvolz\SFML\Window\Window;

class Texture
{
    public function __construct(
        private readonly GraphicsLib $graphicsLib,
        // sfTexture*
        public CData                 $cdata
    )
    {
    }

    public static function create(GraphicsLib $graphicsLib, int $width, int $height): ?self
    {
        $cdata = $graphicsLib->ffi->sfTexture_create($width, $height);
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }

    public static function createFromFile(GraphicsLib $graphicsLib, string $filename, ?IntRect $area = null, bool $srgb = false): ?self
    {
        $cdata = $srgb ? $graphicsLib->ffi->sfTexture_createSrgbFromFile($filename, $area?->cdata) : $graphicsLib->ffi->sfTexture_createFromFile($filename, $area?->cdata);
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }

    public static function createFromMemory(GraphicsLib $graphicsLib, string $data, ?IntRect $area = null, bool $srgb = false): ?self
    {
        $len = strlen($data);
        $dataPtr = FFI::new("char[$len]");
        FFI::memcpy($dataPtr, $data, $len);

        $cdata = $srgb ? $graphicsLib->ffi->sfTexture_createSrgbFromMemory($dataPtr, $len, $area?->cdata) : $graphicsLib->ffi->sfTexture_createFromMemory($dataPtr, $len, $area?->cdata);
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }

    public static function createFromStream(GraphicsLib $graphicsLib, InputStream $stream, ?IntRect $area = null, bool $srgb = false): ?self
    {
        $cdata = $srgb ? $graphicsLib->ffi->sfTexture_createFromStream($stream->cdata, $area?->cdata) : $graphicsLib->ffi->sfTexture_createSrgbFromStream($stream->cdata, $area?->cdata);
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }

    public static function createFromImage(GraphicsLib $graphicsLib, Image $image, ?IntRect $area = null, bool $srgb = false): ?self
    {
        $cdata = $srgb ? $graphicsLib->ffi->sfTexture_createFromImage($image->cdata, $area?->cdata) : $graphicsLib->ffi->sfTexture_createSrgbFromImage($image->cdata, $area?->cdata);
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }

    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfTexture_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfTexture_destroy($this->cdata);
    }

    public function getSize(): Vector2U
    {
        return new Vector2U($this->graphicsLib->ffi->sfTexture_getSize($this->cdata));
    }

    public function copyToImage(): Image
    {
        return new Image($this->graphicsLib, $this->graphicsLib->ffi->sfTexture_copyToImage($this->cdata));
    }

    public function updateFromPixels(PixelArray $pixels, int $x, int $y): void
    {
        $this->graphicsLib->ffi->sfTexture_updateFromPixels($this->cdata, $pixels->cdata, $pixels->width, $pixels->height, $x, $y);
    }

    public function updateFromTexture(Texture $source, int $x, int $y): void
    {
        $this->graphicsLib->ffi->sfTexture_updateFromTexture($this->cdata, $source->cdata, $x, $y);
    }

    public function updateFromImage(Image $source, int $x, int $y): void
    {
        $this->graphicsLib->ffi->sfTexture_updateFromTexture($this->cdata, $source->cdata, $x, $y);
    }

    public function updateFromWindow(Window $source, int $x, int $y): void
    {
        if($source instanceof RenderWindow) {
            $this->graphicsLib->ffi->sfTexture_updateFromRenderWindow($this->cdata, $source->cdata, $x, $y);
        } else {
            $this->graphicsLib->ffi->sfTexture_updateFromWindow($this->cdata, $source->cdata, $x, $y);
        }
    }
    public function setSmooth(bool $smooth): void
    {
        $this->graphicsLib->ffi->sfTexture_setSmooth($this->cdata, $smooth ? 1 : 0);
    }
    public function isSmooth(): bool
    {
        return $this->graphicsLib->ffi->sfTexture_isSmooth($this->cdata) === 1;
    }
    public function isSrgb(): bool
    {
        return $this->graphicsLib->ffi->sfTexture_isSrgb($this->cdata) === 1;
    }
    public function setRepeated(bool $repeated): void
    {
        $this->graphicsLib->ffi->sfTexture_setRepeated($this->cdata, $repeated ? 1 : 0);
    }
    public function isRepeated(): bool
    {
        return $this->graphicsLib->ffi->sfTexture_isRepeated($this->cdata) === 1;
    }
    public function generateMipmap(): void
    {
        $this->graphicsLib->ffi->sfTexture_generateMipmap($this->cdata);
    }
    public function swap(Texture $other): void
    {
        $this->graphicsLib->ffi->sfTexture_swap($this->cdata, $other->cdata);
    }

    public function getNativeHandle(): int
    {
        return $this->graphicsLib->ffi->sfTexture_getNativeHandle($this->cdata);
    }

    public function bind(): void
    {
        $this->graphicsLib->ffi->sfTexture_bind($this->cdata);
    }
    public static function unbind(GraphicsLib $graphicsLib): void
    {
        $graphicsLib->ffi->sfTexture_bind(null);
    }
    public function getMaximumSize(): int
    {
        return $this->graphicsLib->ffi->sfTexture_getMaximumSize($this->cdata);
    }
}