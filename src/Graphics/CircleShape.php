<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;
use LogicException;

class CircleShape implements Shape
{

    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfCircleShape*
        private CData       $cdata)
    {
    }

    public static function create(GraphicsLib $graphicsLib, ?float $radius = null): self
    {
        $self = new self($graphicsLib, $graphicsLib->ffi->sfCircleShape_create());
        if(!is_null($radius)) {
            $self->setRadius($radius);
        }
        return $self;
    }

    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfCircleShape_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfCircleShape_destroy($this->cdata);
    }

    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->graphicsLib->ffi->sfRenderTexture_drawCircleShape($target->cdata, $this->cdata, $renderStates?->cdata);
        } elseif($target instanceof RenderWindow) {
            $this->graphicsLib->ffi->sfRenderWindow_drawCircleShape($target->cdata, $this->cdata, $renderStates?->cdata);
        } else {
            throw new LogicException();
        }
    }

    public function setTexture(Texture $texture, bool $resetRect = false): void
    {
        $this->graphicsLib->ffi->sfCircleShape_setTexture($this->cdata, $texture->cdata, $resetRect ? 1 : 0);
    }

    public function setTextureRect(IntRect $rect): void
    {
        $this->graphicsLib->ffi->sfCircleShape_setTextureRect($this->cdata, $rect->cdata);
    }

    public function setFillColor(Color $color): void
    {
        $this->graphicsLib->ffi->sfCircleShape_setFillColor($this->cdata, $color->cdata);
    }

    public function setOutlineColor(Color $color): void
    {
        $this->graphicsLib->ffi->sfCircleShape_setOutlineColor($this->cdata, $color->cdata);
    }

    public function setOutlineThickness(float $thickness): void
    {
        $this->graphicsLib->ffi->sfCircleShape_setOutlineThickness($this->cdata, $thickness);
    }

    public function getTexture(): Texture
    {
        return new Texture($this->graphicsLib, $this->graphicsLib->ffi->sfCircleShape_getTexture($this->cdata));
    }

    public function getTextureRect(): IntRect
    {
        return new IntRect($this->graphicsLib, $this->graphicsLib->ffi->sfCircleShape_getTextureRect($this->cdata));
    }

    public function getFillColor(): Color
    {
        return new Color($this->graphicsLib, $this->graphicsLib->ffi->sfCircleShape_getFillColor($this->cdata));
    }

    public function getOutlineColor(): Color
    {
        return new Color($this->graphicsLib, $this->graphicsLib->ffi->sfCircleShape_getOutlineColor($this->cdata));
    }

    public function getOutlineThickness(): float
    {
        return $this->graphicsLib->ffi->sfCircleShape_getOutlineThickness($this->cdata);
    }

    public function getPointCount(): int
    {
        return $this->graphicsLib->ffi->sfCircleShape_getPointCount($this->cdata);
    }

    public function setPointCount(int $count): void
    {
        $this->graphicsLib->ffi->sfCircleShape_setPointCount($this->cdata, $count);
    }

    public function getPoint(int $i): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfCircleShape_getPoint($this->cdata, $i));
    }

    public function getLocalBounds(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfCircleShape_getLocalBounds($this->cdata));
    }

    public function getGlobalBounds(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfCircleShape_getGlobalBounds($this->cdata));
    }

    public function setPosition(Vector2F $position): void
    {
        $this->graphicsLib->ffi->sfCircleShape_setPosition($this->cdata, $position->cdata);
    }

    public function setRotation(float $angle): void
    {
        $this->graphicsLib->ffi->sfCircleShape_setRotation($this->cdata, $angle);
    }

    public function setScale(Vector2F $scale): void
    {
        $this->graphicsLib->ffi->sfCircleShape_setScale($this->cdata, $scale->cdata);
    }

    public function setOrigin(Vector2F $origin): void
    {
        $this->graphicsLib->ffi->sfCircleShape_setOrigin($this->cdata, $origin->cdata);
    }

    public function getPosition(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfCircleShape_getPosition($this->cdata));
    }

    public function getRotation(): float
    {
        return $this->graphicsLib->ffi->sfCircleShape_getRotation($this->cdata);
    }

    public function getScale(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfCircleShape_getScale($this->cdata));
    }

    public function getOrigin(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfCircleShape_getOrigin($this->cdata));
    }

    public function move(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfCircleShape_move($this->cdata, $offset->cdata);
    }

    public function rotate(float $offset): void
    {
        $this->graphicsLib->ffi->sfCircleShape_rotate($this->cdata, $offset);
    }

    public function scale(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfCircleShape_scale($this->cdata, $offset->cdata);
    }

    public function getTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfCircleShape_getTransform($this->cdata));
    }

    public function getInverseTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfCircleShape_getInverseTransform($this->cdata));
    }

    public function setRadius(float $radius): void
    {
        $this->graphicsLib->ffi->sfCircleShape_setRadius($this->cdata, $radius);
    }

    public function getRadius(): float
    {
        return $this->graphicsLib->ffi->sfCircleShape_getRadius($this->cdata);
    }
}