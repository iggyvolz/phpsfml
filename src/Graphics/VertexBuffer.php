<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;
use LogicException;
#[CType("sfVertexBuffer*")]
class VertexBuffer extends GraphicsObject implements Drawable
{
    public static function create(
        Sfml $sfml,
        int $vertexCount,
        PrimitiveType $primitiveType = PrimitiveType::Points,
        VertexBufferUsage $usage = VertexBufferUsage::Stream,
    ): self
    {
        return new self($sfml, $sfml->graphics->ffi->sfVertexBuffer_create(
            $vertexCount,
            $primitiveType->value,
            $usage->value
        ));
    }

    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfVertexBuffer_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfVertexBuffer_destroy($this->cdata);
    }

    public function getVertexCount(): int
    {
        return $this->sfml->graphics->ffi->sfVertexBuffer_getVertexCount($this->cdata);
    }

    /**
     * @param list<Vertex>|VertexBuffer $vertexBuffer
     * @return bool
     */
    public function update(array|VertexBuffer $vertexBuffer): bool
    {
        if($vertexBuffer instanceof VertexBuffer) {
            return $this->sfml->graphics->ffi->sfVertexBuffer_updateFromVertexBuffer($this->cdata, $vertexBuffer->asGraphics());
        } else {
            $vertices = $this->sfml->graphics->ffi->new("sfVertex[".count($vertexBuffer)."]");
            foreach ($vertexBuffer as $i => $v) {
                $vertices[$i] = $v->asGraphics();
            }
            return $this->sfml->graphics->ffi->sfVertexBuffer_update($this->cdata, $vertices, count($vertexBuffer), 0);
        }
    }

    public function swap(VertexBuffer $other): void
    {
        $this->sfml->graphics->ffi->sfVertexBuffer_swap($this->cdata, $other->asGraphics());
    }

    public function getNativeHandle(): int
    {
        return $this->sfml->graphics->ffi->sfVertexBuffer_getNativeHandle($this->cdata);
    }

    public function setPrimitiveType(PrimitiveType $type): void
    {
        $this->sfml->graphics->ffi->sfVertexBuffer_setPrimitiveType($type->value);
    }

    public function getPrimitiveType(): PrimitiveType
    {
        return PrimitiveType::from($this->sfml->graphics->ffi->sfVertexBuffer_getPrimitiveType());
    }

    public function setUsage(VertexBufferUsage $usage): void
    {
        $this->sfml->graphics->ffi->sfVertexBuffer_setUsage($usage->value);
    }

    public function getUsage(): VertexBufferUsage
    {
        return VertexBufferUsage::from($this->sfml->graphics->ffi->sfVertexBuffer_getUsage());
    }

    public function bind(): void
    {
        $this->sfml->graphics->ffi->sfVertexBuffer_bind($this->cdata);
    }
    public static function unbind(Sfml $sfml): void
    {
        $sfml->graphics->ffi->sfVertexBuffer_bind(null);
    }
    public function isAvailable(): bool
    {
        return $this->sfml->graphics->ffi->sfVertexBuffer_isAvailable() === 1;
    }


    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->sfml->graphics->ffi->sfRenderTexture_drawVertexBuffer($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } elseif($target instanceof RenderWindow) {
            $this->sfml->graphics->ffi->sfRenderWindow_drawVertexBuffer($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } else {
            throw new LogicException();
        }
    }
}