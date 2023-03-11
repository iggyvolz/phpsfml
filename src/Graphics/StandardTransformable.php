<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;

class StandardTransformable implements Transformable
{

    public function __construct(
        public readonly GraphicsLib $graphicsLib,
        // sfTransformable*
        /**
         * @internal
         */
        public CData $cdata,
    )
    {
    }
    public static function create(GraphicsLib $graphicsLib): self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfTransformable_create());
    }
    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfTransformable_copy($this->cdata);
    }
    public function __destruct()
    {
        $this->graphicsLib->ffi->sfTransformable_destroy($this->cdata);
    }
    public function setPosition(Vector2F $position): void
    {
        $this->graphicsLib->ffi->sfTransformable_setPosition($this->cdata, $position->cdata);
    }
    public function setRotation(float $angle): void
    {
        $this->graphicsLib->ffi->sfTransformable_setRotation($this->cdata, $angle);
    }
    public function setScale(Vector2F $scale): void
    {
        $this->graphicsLib->ffi->sfTransformable_setScale($this->cdata, $scale->cdata);
    }
    public function setOrigin(Vector2F $origin): void
    {
        $this->graphicsLib->ffi->sfTransformable_setOrigin($this->cdata, $origin->cdata);
    }
    public function getPosition(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfTransformable_getPosition($this->cdata));
    }
    public function getRotation(): float
    {
        return new $this->graphicsLib->ffi->sfTransformable_getRotation($this->cdata);
    }
    public function getScale(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfTransformable_getScale($this->cdata));
    }
    public function getOrigin(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfTransformable_getOrigin($this->cdata));
    }
    public function move(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfTransformable_move($this->cdata, $offset->cdata);
    }
    public function rotate(float $offset): void
    {
        $this->graphicsLib->ffi->sfTransformable_rotate($this->cdata, $offset);
    }
    public function scale(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfTransformable_scale($this->cdata, $offset->cdata);
    }
    public function getTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfTransformable_getTransform($this->cdata));
    }
    public function getInverseTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfTransformable_getInverseTransform($this->cdata));
    }
}