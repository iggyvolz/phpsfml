<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\System\Vector\Vector2I;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Window\ContextSettings;
use LogicException;

class VertexBuffer implements Drawable
{
    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfVertexBuffer*
        /** @internal  */
        private CData $cdata
    )
    {
    }
    public static function create(
        GraphicsLib $graphicsLib,
        int $vertexCount,
        PrimitiveType $primitiveType = PrimitiveType::Points,
        VertexBufferUsage $usage = VertexBufferUsage::Stream,
    ): self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfVertexBuffer_create(
            $vertexCount,
            $primitiveType->value,
            $usage->value
        ));
    }

    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfVertexBuffer_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfVertexBuffer_destroy($this->cdata);
    }

    public function getVertexCount(): int
    {
        return $this->graphicsLib->ffi->sfVertexBuffer_getVertexCount($this->cdata);
    }

    /**
     * @param list<Vertex>|VertexBuffer $vertexBuffer
     * @return bool
     */
    public function update(array|VertexBuffer $vertexBuffer): bool
    {
        if($vertexBuffer instanceof VertexBuffer) {
            return $this->graphicsLib->ffi->sfVertexBuffer_updateFromVertexBuffer($this->cdata, $vertexBuffer->cdata);
        } else {
            $vertices = $this->graphicsLib->ffi->new("sfVertex[".count($vertexBuffer)."]");
            foreach ($vertexBuffer as $i => $v) {
                $vertices[$i] = $v->cdata;
            }
            return $this->graphicsLib->ffi->sfVertexBuffer_update($this->cdata, $vertices, count($vertexBuffer), 0);
        }
    }

    public function swap(VertexBuffer $other): void
    {
        $this->graphicsLib->ffi->sfVertexBuffer_swap($this->cdata, $other->cdata);
    }

    public function getNativeHandle(): int
    {
        return $this->graphicsLib->ffi->sfVertexBuffer_getNativeHandle($this->cdata);
    }

    public function setPrimitiveType(PrimitiveType $type): void
    {
        $this->graphicsLib->ffi->sfVertexBuffer_setPrimitiveType($type->value);
    }

    public function getPrimitiveType(): PrimitiveType
    {
        return PrimitiveType::from($this->graphicsLib->ffi->sfVertexBuffer_getPrimitiveType());
    }

    public function setUsage(VertexBufferUsage $usage): void
    {
        $this->graphicsLib->ffi->sfVertexBuffer_setUsage($usage->value);
    }

    public function getUsage(): VertexBufferUsage
    {
        return VertexBufferUsage::from($this->graphicsLib->ffi->sfVertexBuffer_getUsage());
    }

    public function bind(): void
    {
        $this->graphicsLib->ffi->sfVertexBuffer_bind($this->cdata);
    }
    public static function unbind(GraphicsLib $graphicsLib): void
    {
        $graphicsLib->ffi->sfVertexBuffer_bind(null);
    }
    public function isAvailable(): bool
    {
        return $this->graphicsLib->ffi->sfVertexBuffer_isAvailable() === 1;
    }


    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->graphicsLib->ffi->sfRenderTexture_drawVertexBuffer($target->cdata, $this->cdata, $renderStates?->cdata);
        } elseif($target instanceof RenderWindow) {
            $this->graphicsLib->ffi->sfRenderWindow_drawVertexBuffer($target->cdata, $this->cdata, $renderStates?->cdata);
        } else {
            throw new LogicException();
        }
    }
}