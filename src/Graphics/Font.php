<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use FFI\CData;
use iggyvolz\SFML\System\InputStream;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\Utils\UTF32;

class Font
{
    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfFont*
        public CData $cdata
    )
    {
    }

    /**
     * Create a new font from a file
     * @param string $filename Path of the font file to load
     * @return self|null A new sfFont object, or NULL if it failed
     */
    public static function createFromFile(GraphicsLib $graphicsLib, string $filename): ?self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfFont_createFromFile($filename));
    }

    /**
     * Create a new image font a file in memory
     * @param string $data File data
     * @return self|null A new sfFont object, or NULL if it failed
     */
    public static function createFromMemory(GraphicsLib $graphicsLib, string $data): ?self
    {
        $len = strlen($data);
        $dataPtr = FFI::new("char[$len]");
        FFI::memcpy($dataPtr, $data, $len);
        return new self($graphicsLib, $graphicsLib->ffi->sfFont_createFromMemory(FFI::cast("void*", FFI::addr($dataPtr)), $len));
    }

    /**
     * Create a new image font a custom stream
     * @param InputStream $stream Source stream to read from
     * @return self|null A new sfFont object, or NULL if it failed
     */
    public static function createFromStream(GraphicsLib $graphicsLib, InputStream $stream): ?self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfFont_createFromStream($stream->cdata));
    }

    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfFont_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfFont_destroy($this->cdata);
    }

    public function getGlyph(string|int $codePoint, int $characterSize, bool $bold, float $outlineThickness): Glyph
    {
        if(is_string($codePoint)) {
            $codePoint = UTF32::fromString(empty($codePoint) ? "\0" : $codePoint)->cdata[0];
        }
        return new Glyph($this->graphicsLib, $this->graphicsLib->ffi->sfFont_getGlyph($this->cdata, $codePoint, $characterSize, $bold?1:0, $outlineThickness));
    }

    public function getKerning(string|int $first, string|int $second, int $characterSize): float
    {
        if(is_string($first)) {
            $first = UTF32::fromString(empty($first) ? "\0" : $first)->cdata[0];
        }
        if(is_string($second)) {
            $second = UTF32::fromString(empty($second) ? "\0" : $second)->cdata[0];
        }
        return $this->graphicsLib->ffi->sfFont_getKerning($this->cdata, $first, $second, $characterSize);
    }

    public function getLineSpacing(int $characterSize): float
    {
        return $this->graphicsLib->ffi->sfFont_getLineSpacing($this->cdata, $characterSize);
    }

    public function getUnderlinePosition(int $characterSize): float
    {
        return $this->graphicsLib->ffi->sfFont_getUnderlinePosition($this->cdata, $characterSize);
    }

    public function getUnderlineThickness(int $characterSize): float
    {
        return $this->graphicsLib->ffi->sfFont_getUnderlineThickness($this->cdata, $characterSize);
    }

    public function getTexture(int $characterSize): Texture
    {
        return new Texture($this->graphicsLib, $this->graphicsLib->ffi->sfFont_getTexture($this->cdata, $characterSize));
    }

    public function getInfo(): FontInfo
    {
        return new FontInfo($this->graphicsLib->ffi->sfFont_getInfo($this->cdata));
    }
}