<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\Utils\CType;
use LogicException;
#[CType("sfConvexShape*")]
class ConvexShape extends GraphicsObject implements Shape
{
    public static function create(Sfml $sfml, ?array $points = null): self
    {
        $self = new self($sfml, $sfml->graphics->ffi->sfConvexShape_create());
        if(!is_null($points)) {
            $self->setPoints($points);
        }
        return $self;
    }

    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfConvexShape_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfConvexShape_destroy($this->cdata);
    }

    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->sfml->graphics->ffi->sfRenderTexture_drawConvexShape($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } elseif($target instanceof RenderWindow) {
            $this->sfml->graphics->ffi->sfRenderWindow_drawConvexShape($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } else {
            throw new LogicException();
        }
    }

    public function setTexture(Texture $texture, bool $resetRect = false): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_setTexture($this->cdata, $texture->asGraphics(), $resetRect ? 1 : 0);
    }

    public function setTextureRect(IntRect $rect): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_setTextureRect($this->cdata, $rect->asGraphics());
    }

    public function setFillColor(Color $color): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_setFillColor($this->cdata, $color->asGraphics());
    }

    public function setOutlineColor(Color $color): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_setOutlineColor($this->cdata, $color->asGraphics());
    }

    public function setOutlineThickness(float $thickness): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_setOutlineThickness($this->cdata, $thickness);
    }

    public function getTexture(): Texture
    {
        return new Texture($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getTexture($this->cdata));
    }

    public function getTextureRect(): IntRect
    {
        return new IntRect($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getTextureRect($this->cdata));
    }

    public function getFillColor(): Color
    {
        return new Color($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getFillColor($this->cdata));
    }

    public function getOutlineColor(): Color
    {
        return new Color($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getOutlineColor($this->cdata));
    }

    public function getOutlineThickness(): float
    {
        return $this->sfml->graphics->ffi->sfConvexShape_getOutlineThickness($this->cdata);
    }

    public function getPointCount(): int
    {
        return $this->sfml->graphics->ffi->sfConvexShape_getPointCount($this->cdata);
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
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getPoint($this->cdata, $i), true);
    }

    public function setPointCount(int $count): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_setPointCount($this->cdata, $count);
    }

    public function setPoint(int $index, Vector2F $point): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_setPoint($this->cdata, $index, $point->asGraphics());
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
        return new FloatRect($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getLocalBounds($this->cdata));
    }

    public function getGlobalBounds(): FloatRect
    {
        return new FloatRect($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getGlobalBounds($this->cdata));
    }

    public function setPosition(Vector2F $position): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_setPosition($this->cdata, $position->asGraphics());
    }

    public function setRotation(float $angle): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_setRotation($this->cdata, $angle);
    }

    public function setScale(Vector2F $scale): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_setScale($this->cdata, $scale->asGraphics());
    }

    public function setOrigin(Vector2F $origin): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_setOrigin($this->cdata, $origin->asGraphics());
    }

    public function getPosition(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getPosition($this->cdata), true);
    }

    public function getRotation(): float
    {
        return $this->sfml->graphics->ffi->sfConvexShape_getRotation($this->cdata);
    }

    public function getScale(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getScale($this->cdata), true);
    }

    public function getOrigin(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getOrigin($this->cdata), true);
    }

    public function move(Vector2F $offset): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_move($this->cdata, $offset->asGraphics());
    }

    public function rotate(float $offset): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_rotate($this->cdata, $offset);
    }

    public function scale(Vector2F $offset): void
    {
        $this->sfml->graphics->ffi->sfConvexShape_scale($this->cdata, $offset->asGraphics());
    }

    public function getTransform(): Transform
    {
        return new Transform($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getTransform($this->cdata));
    }

    public function getInverseTransform(): Transform
    {
        return new Transform($this->sfml, $this->sfml->graphics->ffi->sfConvexShape_getInverseTransform($this->cdata));
    }
}