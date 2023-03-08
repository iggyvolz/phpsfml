<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use FFI\CData;

class FloatRect
{

    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfFloatRect
        public CData $cdata
    )
    {
    }
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
        GraphicsLib $graphicsLib,
        float $left,
        float $top,
        float $width,
        float $height,
    ): self
    {
        $self = new self($graphicsLib, $graphicsLib->ffi->new("sfFloatRect"));
        $self->setLeft($left);
        $self->setTop($top);
        $self->setWidth($width);
        $self->setHeight($height);
        return $self;
    }
    public static function createFromBoundaries(
        GraphicsLib $graphicsLib,
        float $left,
        float $top,
        float $right,
        float $bottom,
    ) {
        $self = new self($graphicsLib, $graphicsLib->ffi->new("sfFloatRect"));
        $self->setLeft($left);
        $self->setTop($top);
        $self->setRight($right);
        $self->setBottom($bottom);
        return $self;
    }

    public function contains(float $x, float $y): bool
    {
        return $this->graphicsLib->ffi->sfFloatRect_contains($x, $y) === 1;
    }

    /**
     * Check intersection between two rectangles
     * @return self|null An FloatRect if the rectangles intersect, otherwise null
     */
    public function getFloatersection(self $other): ?self
    {
        $intersection = $this->graphicsLib->ffi->new("sfFloatRect");
        if($this->graphicsLib->ffi->sfFloatRect_intersects($this->cdata, $other->cdata, FFI::addr($intersection))) {
            return new self($this->graphicsLib, $intersection);
        }
        return null;
    }

    public function intersects(self $other): bool
    {
        return $this->graphicsLib->ffi->sfFloatRect_intersects($this->cdata, $other->cdata, null) === 1;
    }
}