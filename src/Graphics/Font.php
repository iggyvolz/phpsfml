<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\InputStream;
use iggyvolz\SFML\Utils\CType;
use iggyvolz\SFML\Utils\UTF32;

#[CType("sfFont*")]
class Font extends GraphicsObject
{
    /**
     * Create a new font from a file
     * @param string $filename Path of the font file to load
     * @return self|null A new sfFont object, or NULL if it failed
     */
    public static function createFromFile(Sfml $sfml, string $filename): ?self
    {
        return new self($sfml, $sfml->graphics->ffi->sfFont_createFromFile($filename));
    }

    /**
     * Create a new image font a file in memory
     * @param string $data File data
     * @return self|null A new sfFont object, or NULL if it failed
     */
    public static function createFromMemory(Sfml $sfml, string $data): ?self
    {
        $len = strlen($data);
        $dataPtr = $sfml->graphics->ffi->new("char[$len]");
        FFI::memcpy($dataPtr, $data, $len);
        return new self($sfml, $sfml->graphics->ffi->sfFont_createFromMemory(FFI::cast("void*", FFI::addr($dataPtr)), $len));
    }

    /**
     * Create a new image font a custom stream
     * @param InputStream $stream Source stream to read from
     * @return self|null A new sfFont object, or NULL if it failed
     */
    public static function createFromStream(Sfml $sfml, InputStream $stream): ?self
    {
        return new self($sfml, $sfml->graphics->ffi->sfFont_createFromStream($stream->asGraphics()));
    }

    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfFont_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfFont_destroy($this->cdata);
    }

    public function getGlyph(string|int $codePoint, int $characterSize, bool $bold, float $outlineThickness): Glyph
    {
        if (is_string($codePoint)) {
            $codePoint = UTF32::fromString($this->sfml, empty($codePoint) ? "\0" : $codePoint)->asGraphics()[0];
        }
        return new Glyph($this->sfml, $this->sfml->graphics->ffi->sfFont_getGlyph($this->cdata, $codePoint, $characterSize, $bold ? 1 : 0, $outlineThickness));
    }

    public function getKerning(string|int $first, string|int $second, int $characterSize): float
    {
        if (is_string($first)) {
            $first = UTF32::fromString($this->sfml, empty($first) ? "\0" : $first)->asGraphics()[0];
        }
        if (is_string($second)) {
            $second = UTF32::fromString($this->sfml, empty($second) ? "\0" : $second)->asGraphics()[0];
        }
        return $this->sfml->graphics->ffi->sfFont_getKerning($this->cdata, $first, $second, $characterSize);
    }

    public function getLineSpacing(int $characterSize): float
    {
        return $this->sfml->graphics->ffi->sfFont_getLineSpacing($this->cdata, $characterSize);
    }

    public function getUnderlinePosition(int $characterSize): float
    {
        return $this->sfml->graphics->ffi->sfFont_getUnderlinePosition($this->cdata, $characterSize);
    }

    public function getUnderlineThickness(int $characterSize): float
    {
        return $this->sfml->graphics->ffi->sfFont_getUnderlineThickness($this->cdata, $characterSize);
    }

    public function getTexture(int $characterSize): Texture
    {
        return new Texture($this->sfml, $this->sfml->graphics->ffi->sfFont_getTexture($this->cdata, $characterSize));
    }

    public function getInfo(): FontInfo
    {
        return new FontInfo($this->sfml, $this->sfml->graphics->ffi->sfFont_getInfo($this->cdata));
    }
}