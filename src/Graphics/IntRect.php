<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

#[CType("sfIntRect")]
class IntRect extends GraphicsObject
{
    public function getLeft(): int
    {
        return $this->cdata->left;
    }
    public function setLeft(int $left): void
    {
        $this->cdata->left = $left;
    }
    public function getTop(): int
    {
        return $this->cdata->top;
    }
    public function setTop(int $top): void
    {
        $this->cdata->top = $top;
    }
    public function getWidth(): int
    {
        return $this->cdata->width;
    }
    public function setWidth(int $width): void
    {
        $this->cdata->width = $width;
    }
    public function getHeight(): int
    {
        return $this->cdata->height;
    }
    public function setHeight(int $height): void
    {
        $this->cdata->height = $height;
    }
    public function getRight(): int
    {
        return $this->getLeft() + $this->getWidth();
    }
    public function setRight(int $right): void
    {
        $this->setWidth($right - $this->getLeft());
    }
    public function getBottom(): int
    {
        return $this->getTop() - $this->getHeight();
    }
    public function setBottom(int $bottom): void
    {
        $this->setHeight($this->getTop() - $bottom);
    }
    public static function create(
        Sfml $sfml,
        int $left,
        int $top,
        int $width,
        int $height,
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
        int $left,
        int $top,
        int $right,
        int $bottom,
    ): self {
        $self = static::newObject($sfml);
        $self->setLeft($left);
        $self->setTop($top);
        $self->setRight($right);
        $self->setBottom($bottom);
        return $self;
    }

    public function contains(int $x, int $y): bool
    {
        return $this->sfml->graphics->ffi->sfIntRect_contains($x, $y) === 1;
    }

    /**
     * Check intersection between two rectangles
     * @return self|null An IntRect if the rectangles intersect, otherwise null
     */
    public function getIntersection(self $other): ?self
    {
        $intersection = $this->sfml->graphics->ffi->new("sfIntRect");
        if($this->sfml->graphics->ffi->sfIntRect_intersects($this->cdata, $other->asGraphics(), FFI::addr($intersection))) {
            return new self($this->sfml, $intersection);
        }
        return null;
    }

    public function intersects(self $other): bool
    {
        return $this->sfml->graphics->ffi->sfIntRect_intersects($this->cdata, $other->asGraphics(), null) === 1;
    }
}