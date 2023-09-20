<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;
use LogicException;
#[CType("sfVertexArray*")]
class VertexArray extends GraphicsObject implements Drawable
{
    public static function create(
        Sfml $sfml,
    ): self
    {
        return new self($sfml, $sfml->graphics->ffi->sfVertexArray_create());
    }

    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfVertexArray_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfVertexArray_destroy($this->cdata);
    }

    public function getVertexCount(): int
    {
        return $this->sfml->graphics->ffi->sfVertexArray_getVertexCount($this->cdata);
    }

    public function getVertex(int $index): Vertex
    {
        return new Vertex($this->sfml, $this->sfml->graphics->ffi->sfVertexArray_getVertex($this->cdata, $index));
    }

    public function clear(): void
    {
        $this->sfml->graphics->ffi->sfVertexArray_clear($this->cdata);
    }

    public function resize(int $count): void
    {
        $this->sfml->graphics->ffi->sfVertexArray_resize($this->cdata, $count);
    }

    public function append(Vertex $vertex): void
    {
        $this->sfml->graphics->ffi->sfVertexArray_append($this->cdata, $vertex->asGraphics());
    }

    public function setPrimitiveType(PrimitiveType $type): void
    {
        $this->sfml->graphics->ffi->sfVertexBuffer_setPrimitiveType($type->value);
    }

    public function getPrimitiveType(): PrimitiveType
    {
        return PrimitiveType::from($this->sfml->graphics->ffi->sfVertexBuffer_getPrimitiveType());
    }

    public function getBounds(): FloatRect
    {
        return new FloatRect($this->sfml, $this->sfml->graphics->ffi->sfVertexArray_getBounds());
    }

    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->sfml->graphics->ffi->sfRenderTexture_drawVertexArray($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } elseif($target instanceof RenderWindow) {
            $this->sfml->graphics->ffi->sfRenderWindow_drawVertexArray($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } else {
            throw new LogicException();
        }
    }
}