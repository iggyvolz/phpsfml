<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\Utils\UTF32;
use LogicException;

class Text implements Drawable, Transformable
{
    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfText*
        /** @internal  */
        private CData $cdata
    )
    {
    }
    public static function create(
        GraphicsLib $graphicsLib,
    ): ?self
    {
        $cdata = $graphicsLib->ffi->sfText_create();
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }

    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfText_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfText_destroy($this->cdata);
    }

    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->graphicsLib->ffi->sfRenderTexture_drawText($target->cdata, $this->cdata, $renderStates?->cdata);
        } elseif($target instanceof RenderWindow) {
            $this->graphicsLib->ffi->sfRenderWindow_drawText($target->cdata, $this->cdata, $renderStates?->cdata);
        } else {
            throw new LogicException();
        }
    }

    public function setPosition(Vector2F $position): void
    {
        $this->graphicsLib->ffi->sfText_setPosition($this->cdata, $position->cdata);
    }

    public function setRotation(float $angle): void
    {
        $this->graphicsLib->ffi->sfText_setRotation($this->cdata, $angle);
    }

    public function setScale(Vector2F $scale): void
    {
        $this->graphicsLib->ffi->sfText_setScale($this->cdata, $scale->cdata);
    }

    public function setOrigin(Vector2F $origin): void
    {
        $this->graphicsLib->ffi->sfText_setOrigin($this->cdata, $origin->cdata);
    }

    public function getPosition(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfText_getPosition($this->cdata));
    }

    public function getRotation(): float
    {
        return $this->graphicsLib->ffi->sfText_getRotation($this->cdata);
    }

    public function getScale(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfText_getScale($this->cdata));
    }

    public function getOrigin(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfText_getOrigin($this->cdata));
    }

    public function move(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfText_move($this->cdata, $offset->cdata);
    }

    public function rotate(float $offset): void
    {
        $this->graphicsLib->ffi->sfText_rotate($this->cdata, $offset);
    }

    public function scale(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfText_scale($this->cdata, $offset->cdata);
    }

    public function getTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfText_getTransform($this->cdata));
    }

    public function getInverseTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfText_getInverseTransform($this->cdata));
    }

    public function setString(string $string, string $encoding = "UTF-8"): void
    {
        $this->graphicsLib->ffi->sfText_setUnicodeString($this->cdata, UTF32::fromString($string, $encoding)->cdata);
    }

    public function setFont(Font $font): void
    {
        $this->graphicsLib->ffi->sfText_setFont($this->cdata, $font->cdata);
    }

    public function setCharacterSize(int $size): void
    {
        $this->graphicsLib->ffi->sfText_setCharacterSize($this->cdata, $size);
    }

    public function setLineSpacing(float $spacing): void
    {
        $this->graphicsLib->ffi->sfText_setLineSpacing($this->cdata, $spacing);
    }

    public function setLetterSpacing(float $spacing): void
    {
        $this->graphicsLib->ffi->sfText_setLetterSpacing($this->cdata, $spacing);
    }

    /**
     * @param list<TextStyle> $style
     */
    public function setStyle(array $style): void
    {
        $this->graphicsLib->ffi->sfText_setStyle($this->cdata, TextStyle::toInt(...$style));
    }

    public function setColor(Color $color): void
    {
        $this->graphicsLib->ffi->sfText_setColor($this->cdata, $color->cdata);
    }

    public function setFillColor(Color $color): void
    {
        $this->graphicsLib->ffi->sfText_setFillColor($this->cdata, $color->cdata);
    }

    public function setOutlineColor(Color $color): void
    {
        $this->graphicsLib->ffi->sfText_setOutlineColor($this->cdata, $color->cdata);
    }

    public function setOutlineThickness(float $thickness): void
    {
        $this->graphicsLib->ffi->sfText_setOutlineThickness($this->cdata, $thickness);
    }

    public function getText(string $encoding = "UTF-8"): string
    {
        return (new UTF32($this->graphicsLib->ffi->sfText_getUnicodeString($this->cdata)))->toString($encoding);
    }

    public function getFont(): Font
    {
        return new Font($this->graphicsLib, $this->graphicsLib->ffi->sfText_getFont($this->cdata));
    }

    public function getCharacterSize(): int
    {
        return $this->graphicsLib->ffi->sfText_getCharacterSize($this->cdata);
    }

    public function getLetterSpacing(): float
    {
        return $this->graphicsLib->ffi->sfText_getLetterSpacing($this->cdata);
    }

    public function getLineSpacing(): float
    {
        return $this->graphicsLib->ffi->sfText_getLineSpacing($this->cdata);
    }

    /**
     * @return list<TextStyle>
     */
    public function getStyle(): array
    {
        return TextStyle::fromInt($this->graphicsLib->ffi->sfText_getStyle($this->cdata));
    }

    public function getFillColor(): Color
    {
        return new Color($this->graphicsLib, $this->graphicsLib->ffi->sfText_getFillColor($this->cdata));
    }

    public function getOutlineColor(): Color
    {
        return new Color($this->graphicsLib, $this->graphicsLib->ffi->sfText_getOutlineColor($this->cdata));
    }

    public function getOutlineThickness(): float
    {
        return $this->graphicsLib->ffi->sfText_getOutlineThickness($this->cdata);
    }

    public function findCharacterPos(int $index): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfText_findCharacterPos($this->cdata));
    }

    public function getLocalBounds(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfText_getLocalBounds($this->cdata));
    }

    public function getGlobalBounds(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfText_getGlobalBounds($this->cdata));
    }

}