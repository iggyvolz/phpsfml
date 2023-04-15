<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\Utils\CType;
use iggyvolz\SFML\Utils\UTF32;
use LogicException;
#[CType("sfText*")]
class Text extends GraphicsObject implements Drawable, Transformable
{
    public static function create(
        Sfml $sfml,
    ): ?self
    {
        $cdata = $sfml->graphics->ffi->sfText_create();
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }

    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfText_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfText_destroy($this->cdata);
    }

    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->sfml->graphics->ffi->sfRenderTexture_drawText($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } elseif($target instanceof RenderWindow) {
            $this->sfml->graphics->ffi->sfRenderWindow_drawText($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } else {
            throw new LogicException();
        }
    }

    public function setPosition(Vector2F $position): void
    {
        $this->sfml->graphics->ffi->sfText_setPosition($this->cdata, $position->asGraphics());
    }

    public function setRotation(float $angle): void
    {
        $this->sfml->graphics->ffi->sfText_setRotation($this->cdata, $angle);
    }

    public function setScale(Vector2F $scale): void
    {
        $this->sfml->graphics->ffi->sfText_setScale($this->cdata, $scale->asGraphics());
    }

    public function setOrigin(Vector2F $origin): void
    {
        $this->sfml->graphics->ffi->sfText_setOrigin($this->cdata, $origin->asGraphics());
    }

    public function getPosition(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfText_getPosition($this->cdata), true);
    }

    public function getRotation(): float
    {
        return $this->sfml->graphics->ffi->sfText_getRotation($this->cdata);
    }

    public function getScale(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfText_getScale($this->cdata), true);
    }

    public function getOrigin(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfText_getOrigin($this->cdata), true);
    }

    public function move(Vector2F $offset): void
    {
        $this->sfml->graphics->ffi->sfText_move($this->cdata, $offset->asGraphics());
    }

    public function rotate(float $offset): void
    {
        $this->sfml->graphics->ffi->sfText_rotate($this->cdata, $offset);
    }

    public function scale(Vector2F $offset): void
    {
        $this->sfml->graphics->ffi->sfText_scale($this->cdata, $offset->asGraphics());
    }

    public function getTransform(): Transform
    {
        return new Transform($this->sfml, $this->sfml->graphics->ffi->sfText_getTransform($this->cdata));
    }

    public function getInverseTransform(): Transform
    {
        return new Transform($this->sfml, $this->sfml->graphics->ffi->sfText_getInverseTransform($this->cdata));
    }

    public function setString(string $string, string $encoding = "UTF-8"): void
    {
        $this->sfml->graphics->ffi->sfText_setUnicodeString($this->cdata, UTF32::fromString($this->sfml, $string, $encoding)->asGraphics());
    }

    public function setFont(Font $font): void
    {
        $this->sfml->graphics->ffi->sfText_setFont($this->cdata, $font->asGraphics());
    }

    public function setCharacterSize(int $size): void
    {
        $this->sfml->graphics->ffi->sfText_setCharacterSize($this->cdata, $size);
    }

    public function setLineSpacing(float $spacing): void
    {
        $this->sfml->graphics->ffi->sfText_setLineSpacing($this->cdata, $spacing);
    }

    public function setLetterSpacing(float $spacing): void
    {
        $this->sfml->graphics->ffi->sfText_setLetterSpacing($this->cdata, $spacing);
    }

    /**
     * @param list<TextStyle> $style
     */
    public function setStyle(array $style): void
    {
        $this->sfml->graphics->ffi->sfText_setStyle($this->cdata, TextStyle::toInt(...$style));
    }

    public function setColor(Color $color): void
    {
        $this->sfml->graphics->ffi->sfText_setColor($this->cdata, $color->asGraphics());
    }

    public function setFillColor(Color $color): void
    {
        $this->sfml->graphics->ffi->sfText_setFillColor($this->cdata, $color->asGraphics());
    }

    public function setOutlineColor(Color $color): void
    {
        $this->sfml->graphics->ffi->sfText_setOutlineColor($this->cdata, $color->asGraphics());
    }

    public function setOutlineThickness(float $thickness): void
    {
        $this->sfml->graphics->ffi->sfText_setOutlineThickness($this->cdata, $thickness);
    }

    public function getText(string $encoding = "UTF-8"): string
    {
        return (new UTF32($this->sfml, $this->sfml->graphics->ffi->sfText_getUnicodeString($this->cdata)))->toString($encoding);
    }

    public function getFont(): Font
    {
        return new Font($this->sfml, $this->sfml->graphics->ffi->sfText_getFont($this->cdata));
    }

    public function getCharacterSize(): int
    {
        return $this->sfml->graphics->ffi->sfText_getCharacterSize($this->cdata);
    }

    public function getLetterSpacing(): float
    {
        return $this->sfml->graphics->ffi->sfText_getLetterSpacing($this->cdata);
    }

    public function getLineSpacing(): float
    {
        return $this->sfml->graphics->ffi->sfText_getLineSpacing($this->cdata);
    }

    /**
     * @return list<TextStyle>
     */
    public function getStyle(): array
    {
        return TextStyle::fromInt($this->sfml->graphics->ffi->sfText_getStyle($this->cdata));
    }

    public function getFillColor(): Color
    {
        return new Color($this->sfml, $this->sfml->graphics->ffi->sfText_getFillColor($this->cdata));
    }

    public function getOutlineColor(): Color
    {
        return new Color($this->sfml, $this->sfml->graphics->ffi->sfText_getOutlineColor($this->cdata));
    }

    public function getOutlineThickness(): float
    {
        return $this->sfml->graphics->ffi->sfText_getOutlineThickness($this->cdata);
    }

    public function findCharacterPos(int $index): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfText_findCharacterPos($this->cdata), true);
    }

    public function getLocalBounds(): FloatRect
    {
        return new FloatRect($this->sfml, $this->sfml->graphics->ffi->sfText_getLocalBounds($this->cdata));
    }

    public function getGlobalBounds(): FloatRect
    {
        return new FloatRect($this->sfml, $this->sfml->graphics->ffi->sfText_getGlobalBounds($this->cdata));
    }

}