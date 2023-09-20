<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\Utils\CType;
use LogicException;

#[CType("sfCircleShape*")]
class CircleShape extends GraphicsObject implements Shape
{
    public static function create(Sfml $sfml, float $radius = 0): self
    {
        $self = new self($sfml, $sfml->graphics->ffi->sfCircleShape_create());
        if($radius !== 0) {
            $self->setRadius($radius);
        }
        return $self;
    }

    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfCircleShape_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfCircleShape_destroy($this->cdata);
    }

    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->sfml->graphics->ffi->sfRenderTexture_drawCircleShape($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } elseif($target instanceof RenderWindow) {
            $this->sfml->graphics->ffi->sfRenderWindow_drawCircleShape($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } else {
            throw new LogicException();
        }
    }

    public function setTexture(Texture $texture, bool $resetRect = false): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_setTexture($this->cdata, $texture->asGraphics(), $resetRect ? 1 : 0);
    }

    public function setTextureRect(IntRect $rect): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_setTextureRect($this->cdata, $rect->asGraphics());
    }

    public function setFillColor(Color $color): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_setFillColor($this->cdata, $color->asGraphics());
    }

    public function setOutlineColor(Color $color): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_setOutlineColor($this->cdata, $color->asGraphics());
    }

    public function setOutlineThickness(float $thickness): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_setOutlineThickness($this->cdata, $thickness);
    }

    public function getTexture(): Texture
    {
        return new Texture($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getTexture($this->cdata));
    }

    public function getTextureRect(): IntRect
    {
        return new IntRect($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getTextureRect($this->cdata));
    }

    public function getFillColor(): Color
    {
        return new Color($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getFillColor($this->cdata));
    }

    public function getOutlineColor(): Color
    {
        return new Color($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getOutlineColor($this->cdata));
    }

    public function getOutlineThickness(): float
    {
        return $this->sfml->graphics->ffi->sfCircleShape_getOutlineThickness($this->cdata);
    }

    public function getPointCount(): int
    {
        return $this->sfml->graphics->ffi->sfCircleShape_getPointCount($this->cdata);
    }

    public function setPointCount(int $count): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_setPointCount($this->cdata, $count);
    }

    public function getPoint(int $i): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getPoint($this->cdata, $i), true);
    }

    public function getLocalBounds(): FloatRect
    {
        return new FloatRect($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getLocalBounds($this->cdata));
    }

    public function getGlobalBounds(): FloatRect
    {
        return new FloatRect($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getGlobalBounds($this->cdata));
    }

    public function setPosition(Vector2F $position): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_setPosition($this->cdata, $position->asGraphics());
    }

    public function setRotation(float $angle): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_setRotation($this->cdata, $angle);
    }

    public function setScale(Vector2F $scale): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_setScale($this->cdata, $scale->asGraphics());
    }

    public function setOrigin(Vector2F $origin): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_setOrigin($this->cdata, $origin->asGraphics());
    }

    public function getPosition(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getPosition($this->cdata), true);
    }

    public function getRotation(): float
    {
        return $this->sfml->graphics->ffi->sfCircleShape_getRotation($this->cdata);
    }

    public function getScale(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getScale($this->cdata), true);
    }

    public function getOrigin(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getOrigin($this->cdata), true);
    }

    public function move(Vector2F $offset): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_move($this->cdata, $offset->asGraphics());
    }

    public function rotate(float $offset): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_rotate($this->cdata, $offset);
    }

    public function scale(Vector2F $offset): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_scale($this->cdata, $offset->asGraphics());
    }

    public function getTransform(): Transform
    {
        return new Transform($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getTransform($this->cdata));
    }

    public function getInverseTransform(): Transform
    {
        return new Transform($this->sfml, $this->sfml->graphics->ffi->sfCircleShape_getInverseTransform($this->cdata));
    }

    public function setRadius(float $radius): void
    {
        $this->sfml->graphics->ffi->sfCircleShape_setRadius($this->cdata, $radius);
    }

    public function getRadius(): float
    {
        return $this->sfml->graphics->ffi->sfCircleShape_getRadius($this->cdata);
    }
}