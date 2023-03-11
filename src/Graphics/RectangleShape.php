<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;
use LogicException;

class RectangleShape implements Shape
{

    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfRectangleShape*
        private CData       $cdata)
    {
    }

    public static function create(GraphicsLib $graphicsLib, ?Vector2F $size = null): self
    {
        $self = new self($graphicsLib, $graphicsLib->ffi->sfRectangleShape_create());
        if(!is_null($size)) {
            $self->setSize($size);
        }
        return $self;
    }

    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfRectangleShape_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfRectangleShape_destroy($this->cdata);
    }

    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->graphicsLib->ffi->sfRenderTexture_drawRectangleShape($target->cdata, $this->cdata, $renderStates?->cdata);
        } elseif($target instanceof RenderWindow) {
            $this->graphicsLib->ffi->sfRenderWindow_drawRectangleShape($target->cdata, $this->cdata, $renderStates?->cdata);
        } else {
            throw new LogicException();
        }
    }

    public function setTexture(Texture $texture, bool $resetRect = false): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_setTexture($this->cdata, $texture->cdata, $resetRect ? 1 : 0);
    }

    public function setTextureRect(IntRect $rect): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_setTextureRect($this->cdata, $rect->cdata);
    }

    public function setFillColor(Color $color): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_setFillColor($this->cdata, $color->cdata);
    }

    public function setOutlineColor(Color $color): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_setOutlineColor($this->cdata, $color->cdata);
    }

    public function setOutlineThickness(float $thickness): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_setOutlineThickness($this->cdata, $thickness);
    }

    public function getTexture(): Texture
    {
        return new Texture($this->graphicsLib, $this->graphicsLib->ffi->sfRectangleShape_getTexture($this->cdata));
    }

    public function getTextureRect(): IntRect
    {
        return new IntRect($this->graphicsLib, $this->graphicsLib->ffi->sfRectangleShape_getTextureRect($this->cdata));
    }

    public function getFillColor(): Color
    {
        return new Color($this->graphicsLib, $this->graphicsLib->ffi->sfRectangleShape_getFillColor($this->cdata));
    }

    public function getOutlineColor(): Color
    {
        return new Color($this->graphicsLib, $this->graphicsLib->ffi->sfRectangleShape_getOutlineColor($this->cdata));
    }

    public function getOutlineThickness(): float
    {
        return $this->graphicsLib->ffi->sfRectangleShape_getOutlineThickness($this->cdata);
    }

    public function getPointCount(): int
    {
        return $this->graphicsLib->ffi->sfRectangleShape_getPointCount($this->cdata);
    }

    public function getPoint(int $i): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfRectangleShape_getPoint($this->cdata, $i));
    }

    public function getLocalBounds(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfRectangleShape_getLocalBounds($this->cdata));
    }

    public function getGlobalBounds(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfRectangleShape_getGlobalBounds($this->cdata));
    }

    public function setPosition(Vector2F $position): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_setPosition($this->cdata, $position->cdata);
    }

    public function setRotation(float $angle): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_setRotation($this->cdata, $angle);
    }

    public function setScale(Vector2F $scale): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_setScale($this->cdata, $scale->cdata);
    }

    public function setOrigin(Vector2F $origin): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_setOrigin($this->cdata, $origin->cdata);
    }

    public function getPosition(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfRectangleShape_getPosition($this->cdata));
    }

    public function getRotation(): float
    {
        return $this->graphicsLib->ffi->sfRectangleShape_getRotation($this->cdata);
    }

    public function getScale(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfRectangleShape_getScale($this->cdata));
    }

    public function getOrigin(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfRectangleShape_getOrigin($this->cdata));
    }

    public function move(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_move($this->cdata, $offset->cdata);
    }

    public function rotate(float $offset): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_rotate($this->cdata, $offset);
    }

    public function scale(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_scale($this->cdata, $offset->cdata);
    }

    public function getTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfRectangleShape_getTransform($this->cdata));
    }

    public function getInverseTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfRectangleShape_getInverseTransform($this->cdata));
    }

    public function setSize(Vector2F $size): void
    {
        $this->graphicsLib->ffi->sfRectangleShape_setSize($this->cdata, $this->graphicsLib->ffi->cast("sfVector2f", $size->cdata));
    }

    public function getSize(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfRectangleShape_getSize($this->cdata));
    }
}