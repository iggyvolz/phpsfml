<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

#[CType("sfFloatRect")]
class FloatRect extends GraphicsObject
{
    public function getLeft(): float
    {
        return $this->cdata->left;
    }
    public function setLeft(float $left): void
    {
        $this->cdata->left = $left;
    }
    public function getTop(): float
    {
        return $this->cdata->top;
    }
    public function setTop(float $top): void
    {
        $this->cdata->top = $top;
    }
    public function getWidth(): float
    {
        return $this->cdata->width;
    }
    public function setWidth(float $width): void
    {
        $this->cdata->width = $width;
    }
    public function getHeight(): float
    {
        return $this->cdata->height;
    }
    public function setHeight(float $height): void
    {
        $this->cdata->height = $height;
    }
    public function getRight(): float
    {
        return $this->getLeft() + $this->getWidth();
    }
    public function setRight(float $right): void
    {
        $this->setWidth($right - $this->getLeft());
    }
    public function getBottom(): float
    {
        return $this->getTop() - $this->getHeight();
    }
    public function setBottom(float $bottom): void
    {
        $this->setHeight($this->getTop() - $bottom);
    }
    public static function create(
        Sfml $sfml,
        float $left,
        float $top,
        float $width,
        float $height,
    ): self
    {
        $self = static::newObject($sfml);
        $self->setLeft($left);
        $self->setTop($top);
        $self->setWidth($width);
        $self->setHeight($height);
        return $self;
    }
    public static function createFromBoundaries(
        Sfml $sfml,
        float $left,
        float $top,
        float $right,
        float $bottom,
    ): self {
        $self = static::newObject($sfml);
        $self->setLeft($left);
        $self->setTop($top);
        $self->setRight($right);
        $self->setBottom($bottom);
        return $self;
    }

    public function contains(float $x, float $y): bool
    {
        return $this->sfml->graphics->ffi->sfFloatRect_contains($x, $y) === 1;
    }

    /**
     * Check intersection between two rectangles
     * @return self|null An FloatRect if the rectangles intersect, otherwise null
     */
    public function getFloatersection(self $other): ?self
    {
        $intersection = $this->sfml->graphics->ffi->new("sfFloatRect");
        if($this->sfml->graphics->ffi->sfFloatRect_intersects($this->cdata, $other->asGraphics(), FFI::addr($intersection))) {
            return new self($this->sfml, $intersection);
        }
        return null;
    }

    public function intersects(self $other): bool
    {
        return $this->sfml->graphics->ffi->sfFloatRect_intersects($this->cdata, $other->asGraphics(), null) === 1;
    }
}