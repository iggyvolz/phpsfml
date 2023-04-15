<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\Utils\CType;

#[CType("sfTransformable*")]
class StandardTransformable extends GraphicsObject implements Transformable
{
    public static function create(Sfml $sfml): self
    {
        return new self($sfml, $sfml->graphics->ffi->sfTransformable_create());
    }
    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfTransformable_copy($this->cdata);
    }
    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfTransformable_destroy($this->cdata);
    }
    public function setPosition(Vector2F $position): void
    {
        $this->sfml->graphics->ffi->sfTransformable_setPosition($this->cdata, $position->asGraphics());
    }
    public function setRotation(float $angle): void
    {
        $this->sfml->graphics->ffi->sfTransformable_setRotation($this->cdata, $angle);
    }
    public function setScale(Vector2F $scale): void
    {
        $this->sfml->graphics->ffi->sfTransformable_setScale($this->cdata, $scale->asGraphics());
    }
    public function setOrigin(Vector2F $origin): void
    {
        $this->sfml->graphics->ffi->sfTransformable_setOrigin($this->cdata, $origin->asGraphics());
    }
    public function getPosition(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfTransformable_getPosition($this->cdata), true);
    }
    public function getRotation(): float
    {
        return new $this->sfml->graphics->ffi->sfTransformable_getRotation($this->cdata);
    }
    public function getScale(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfTransformable_getScale($this->cdata), true);
    }
    public function getOrigin(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfTransformable_getOrigin($this->cdata), true);
    }
    public function move(Vector2F $offset): void
    {
        $this->sfml->graphics->ffi->sfTransformable_move($this->cdata, $offset->asGraphics());
    }
    public function rotate(float $offset): void
    {
        $this->sfml->graphics->ffi->sfTransformable_rotate($this->cdata, $offset);
    }
    public function scale(Vector2F $offset): void
    {
        $this->sfml->graphics->ffi->sfTransformable_scale($this->cdata, $offset->asGraphics());
    }
    public function getTransform(): Transform
    {
        return new Transform($this->sfml, $this->sfml->graphics->ffi->sfTransformable_getTransform($this->cdata));
    }
    public function getInverseTransform(): Transform
    {
        return new Transform($this->sfml, $this->sfml->graphics->ffi->sfTransformable_getInverseTransform($this->cdata));
    }
}