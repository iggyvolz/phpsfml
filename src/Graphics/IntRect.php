<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use FFI\CData;

class IntRect
{
    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfIntRect
        public CData $cdata
    )
    {
    }
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
        GraphicsLib $graphicsLib,
        int $left,
        int $top,
        int $width,
        int $height,
    ): self
    {
        $self = new self($graphicsLib, $graphicsLib->ffi->new("sfIntRect"));
        $self->setLeft($left);
        $self->setTop($top);
        $self->setWidth($width);
        $self->setHeight($height);
        return $self;
    }
    public static function createFromBoundaries(
        GraphicsLib $graphicsLib,
        int $left,
        int $top,
        int $right,
        int $bottom,
    ) {
        $self = new self($graphicsLib, $graphicsLib->ffi->new("sfIntRect"));
        $self->setLeft($left);
        $self->setTop($top);
        $self->setRight($right);
        $self->setBottom($bottom);
        return $self;
    }

    public function contains(int $x, int $y): bool
    {
        return $this->graphicsLib->ffi->sfIntRect_contains($x, $y) === 1;
    }

    /**
     * Check intersection between two rectangles
     * @return self|null An IntRect if the rectangles intersect, otherwise null
     */
    public function getIntersection(self $other): ?self
    {
        $intersection = $this->graphicsLib->ffi->new("sfIntRect");
        if($this->graphicsLib->ffi->sfIntRect_intersects($this->cdata, $other->cdata, FFI::addr($intersection))) {
            return new self($this->graphicsLib, $intersection);
        }
        return null;
    }

    public function intersects(self $other): bool
    {
        return $this->graphicsLib->ffi->sfIntRect_intersects($this->cdata, $other->cdata, null) === 1;
    }
}