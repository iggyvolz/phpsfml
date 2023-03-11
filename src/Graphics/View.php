<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;

class View
{
    public function __construct(
        public readonly GraphicsLib $graphicsLib,
        // sfView*
        /**
         * @internal
         */
        public CData $cdata,
    )
    {
    }
    public static function create(GraphicsLib $graphicsLib, ?FloatRect $rectangle = null): self
    {
        return new self($graphicsLib, is_null($rectangle) ? $graphicsLib->ffi->sfView_create() : $graphicsLib->ffi->sfView_createFromRect($rectangle->cdata));
    }
    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfView_copy($this->cdata);
    }
    public function __destruct()
    {
        $this->graphicsLib->ffi->sfView_destroy($this->cdata);
    }

    public function setCenter(Vector2F $center): void
    {
        $this->graphicsLib->ffi->sfView_setCenter($this->cdata, $center->cdata);
    }

    public function setSize(Vector2F $size): void
    {
        $this->graphicsLib->ffi->sfView_setSize($this->cdata, $size->cdata);
    }
    public function setRotation(float $angle): void
    {
        $this->graphicsLib->ffi->sfView_setSize($this->cdata, $angle);
    }
    public function setViewport(Vector2F $viewport): void
    {
        $this->graphicsLib->ffi->sfView_setViewport($this->cdata, $viewport->cdata);
    }
    public function reset(FloatRect $rectangle): void
    {
        $this->graphicsLib->ffi->sfView_reset($this->cdata, $rectangle->cdata);
    }
    public function getCenter(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfView_getCenter($this->cdata));
    }
    public function getSize(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfView_getSize($this->cdata));
    }
    public function getRotation(): float
    {
        return $this->graphicsLib->ffi->sfView_getRotation($this->cdata);
    }
    public function getViewport(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfView_getViewport($this->cdata));
    }
    public function move(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfView_move($this->cdata, $offset->cdata);
    }
    public function rotate(float $angle): void
    {
        $this->graphicsLib->ffi->sfView_rotate($this->cdata, $angle);
    }
    public function zoom(float $factor): void
    {
        $this->graphicsLib->ffi->sfView_rotate($this->cdata, $factor);
    }
}