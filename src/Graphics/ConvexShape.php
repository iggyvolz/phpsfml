<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;
use LogicException;

class ConvexShape implements Shape
{

    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfConvexShape*
        private CData       $cdata)
    {
    }

    public static function create(GraphicsLib $graphicsLib, ?array $points = null): self
    {
        $self = new self($graphicsLib, $graphicsLib->ffi->sfConvexShape_create());
        if(!is_null($points)) {
            $self->setPoints($points);
        }
        return $self;
    }

    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfConvexShape_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfConvexShape_destroy($this->cdata);
    }

    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->graphicsLib->ffi->sfRenderTexture_drawConvexShape($target->cdata, $this->cdata, $renderStates?->cdata);
        } elseif($target instanceof RenderWindow) {
            $this->graphicsLib->ffi->sfRenderWindow_drawConvexShape($target->cdata, $this->cdata, $renderStates?->cdata);
        } else {
            throw new LogicException();
        }
    }

    public function setTexture(Texture $texture, bool $resetRect = false): void
    {
        $this->graphicsLib->ffi->sfConvexShape_setTexture($this->cdata, $texture->cdata, $resetRect ? 1 : 0);
    }

    public function setTextureRect(IntRect $rect): void
    {
        $this->graphicsLib->ffi->sfConvexShape_setTextureRect($this->cdata, $rect->cdata);
    }

    public function setFillColor(Color $color): void
    {
        $this->graphicsLib->ffi->sfConvexShape_setFillColor($this->cdata, $color->cdata);
    }

    public function setOutlineColor(Color $color): void
    {
        $this->graphicsLib->ffi->sfConvexShape_setOutlineColor($this->cdata, $color->cdata);
    }

    public function setOutlineThickness(float $thickness): void
    {
        $this->graphicsLib->ffi->sfConvexShape_setOutlineThickness($this->cdata, $thickness);
    }

    public function getTexture(): Texture
    {
        return new Texture($this->graphicsLib, $this->graphicsLib->ffi->sfConvexShape_getTexture($this->cdata));
    }

    public function getTextureRect(): IntRect
    {
        return new IntRect($this->graphicsLib, $this->graphicsLib->ffi->sfConvexShape_getTextureRect($this->cdata));
    }

    public function getFillColor(): Color
    {
        return new Color($this->graphicsLib, $this->graphicsLib->ffi->sfConvexShape_getFillColor($this->cdata));
    }

    public function getOutlineColor(): Color
    {
        return new Color($this->graphicsLib, $this->graphicsLib->ffi->sfConvexShape_getOutlineColor($this->cdata));
    }

    public function getOutlineThickness(): float
    {
        return $this->graphicsLib->ffi->sfConvexShape_getOutlineThickness($this->cdata);
    }

    public function getPointCount(): int
    {
        return $this->graphicsLib->ffi->sfConvexShape_getPointCount($this->cdata);
    }

    /**
     * @return list<Vector2F>
     */
    public function getPoints(): array
    {
        $arr = [];
        $count = $this->getPoints();
        for($i = 0; $i<$count; $i++) {
            $arr[$i] = $this->getPoint($i);
        }
        return $arr;
    }

    public function getPoint(int $i): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfConvexShape_getPoint($this->cdata, $i));
    }

    public function setPointCount(int $count): void
    {
        $this->graphicsLib->ffi->sfConvexShape_setPointCount($this->cdata, $count);
    }

    public function setPoint(int $index, Vector2F $point): void
    {
        $this->graphicsLib->ffi->sfConvexShape_setPoint($this->cdata, $index, $point->cdata);
    }

    /**
     * @param list<Vector2F> $points
     * @return void
     */
    public function setPoints(array $points): void
    {
        $this->setPointCount(count($points));
        foreach ($points as $i => $point) {
            $this->setPoint($i, $point);
        }
    }

    public function getLocalBounds(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfConvexShape_getLocalBounds($this->cdata));
    }

    public function getGlobalBounds(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfConvexShape_getGlobalBounds($this->cdata));
    }

    public function setPosition(Vector2F $position): void
    {
        $this->graphicsLib->ffi->sfConvexShape_setPosition($this->cdata, $position->cdata);
    }

    public function setRotation(float $angle): void
    {
        $this->graphicsLib->ffi->sfConvexShape_setRotation($this->cdata, $angle);
    }

    public function setScale(Vector2F $scale): void
    {
        $this->graphicsLib->ffi->sfConvexShape_setScale($this->cdata, $scale->cdata);
    }

    public function setOrigin(Vector2F $origin): void
    {
        $this->graphicsLib->ffi->sfConvexShape_setOrigin($this->cdata, $origin->cdata);
    }

    public function getPosition(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfConvexShape_getPosition($this->cdata));
    }

    public function getRotation(): float
    {
        return $this->graphicsLib->ffi->sfConvexShape_getRotation($this->cdata);
    }

    public function getScale(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfConvexShape_getScale($this->cdata));
    }

    public function getOrigin(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfConvexShape_getOrigin($this->cdata));
    }

    public function move(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfConvexShape_move($this->cdata, $offset->cdata);
    }

    public function rotate(float $offset): void
    {
        $this->graphicsLib->ffi->sfConvexShape_rotate($this->cdata, $offset);
    }

    public function scale(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfConvexShape_scale($this->cdata, $offset->cdata);
    }

    public function getTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfConvexShape_getTransform($this->cdata));
    }

    public function getInverseTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfConvexShape_getInverseTransform($this->cdata));
    }
}