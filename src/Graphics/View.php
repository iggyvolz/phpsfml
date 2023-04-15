<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\Utils\CType;

#[CType("sfView*")]
class View extends GraphicsObject
{
    public static function create(Sfml $sfml, ?FloatRect $rectangle = null): self
    {
        return new self($sfml, is_null($rectangle) ? $sfml->graphics->ffi->sfView_create() : $sfml->graphics->ffi->sfView_createFromRect($rectangle->asGraphics()));
    }
    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfView_copy($this->cdata);
    }
    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfView_destroy($this->cdata);
    }

    public function setCenter(Vector2F $center): void
    {
        $this->sfml->graphics->ffi->sfView_setCenter($this->cdata, $center->asGraphics());
    }

    public function setSize(Vector2F $size): void
    {
        $this->sfml->graphics->ffi->sfView_setSize($this->cdata, $size->asGraphics());
    }
    public function setRotation(float $angle): void
    {
        $this->sfml->graphics->ffi->sfView_setSize($this->cdata, $angle);
    }
    public function setViewport(Vector2F $viewport): void
    {
        $this->sfml->graphics->ffi->sfView_setViewport($this->cdata, $viewport->asGraphics());
    }
    public function reset(FloatRect $rectangle): void
    {
        $this->sfml->graphics->ffi->sfView_reset($this->cdata, $rectangle->asGraphics());
    }
    public function getCenter(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfView_getCenter($this->cdata), true);
    }
    public function getSize(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfView_getSize($this->cdata), true);
    }
    public function getRotation(): float
    {
        return $this->sfml->graphics->ffi->sfView_getRotation($this->cdata);
    }
    public function getViewport(): FloatRect
    {
        return new FloatRect($this->sfml, $this->sfml->graphics->ffi->sfView_getViewport($this->cdata));
    }
    public function move(Vector2F $offset): void
    {
        $this->sfml->graphics->ffi->sfView_move($this->cdata, $offset->asGraphics());
    }
    public function rotate(float $angle): void
    {
        $this->sfml->graphics->ffi->sfView_rotate($this->cdata, $angle);
    }
    public function zoom(float $factor): void
    {
        $this->sfml->graphics->ffi->sfView_rotate($this->cdata, $factor);
    }
}