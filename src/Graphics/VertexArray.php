<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use LogicException;

class VertexArray implements Drawable
{
    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfVertexArray*
        /** @internal  */
        private CData $cdata
    )
    {
    }
    public static function create(
        GraphicsLib $graphicsLib,
    ): self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfVertexArray_create());
    }

    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfVertexArray_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfVertexArray_destroy($this->cdata);
    }

    public function getVertexCount(): int
    {
        return $this->graphicsLib->ffi->sfVertexArray_getVertexCount($this->cdata);
    }

    public function getVertex(int $index): Vertex
    {
        return new Vertex($this->graphicsLib->ffi->sfVertexArray_getVertex($this->cdata, $index));
    }

    public function clear(): void
    {
        $this->graphicsLib->ffi->sfVertexArray_clear($this->cdata);
    }

    public function resize(int $count): void
    {
        $this->graphicsLib->ffi->sfVertexArray_resize($this->cdata, $count);
    }

    public function append(Vertex $vertex): void
    {
        $this->graphicsLib->ffi->sfVertexArray_append($this->cdata, $vertex->cdata);
    }

    public function setPrimitiveType(PrimitiveType $type): void
    {
        $this->graphicsLib->ffi->sfVertexBuffer_setPrimitiveType($type->value);
    }

    public function getPrimitiveType(): PrimitiveType
    {
        return PrimitiveType::from($this->graphicsLib->ffi->sfVertexBuffer_getPrimitiveType());
    }

    public function getBounds(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfVertexArray_getBounds());
    }

    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->graphicsLib->ffi->sfRenderTexture_drawVertexArray($target->cdata, $this->cdata, $renderStates?->cdata);
        } elseif($target instanceof RenderWindow) {
            $this->graphicsLib->ffi->sfRenderWindow_drawVertexArray($target->cdata, $this->cdata, $renderStates?->cdata);
        } else {
            throw new LogicException();
        }
    }
}