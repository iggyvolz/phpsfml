<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\System\Vector\Vector2I;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Window\ContextSettings;

readonly class Vertex
{
    public function __construct(
        // sfVertex
        /** @internal  */
        public CData $cdata
    )
    {
    }
    public static function create(
        GraphicsLib $graphicsLib,
        Vector2F $position,
        Color $color,
        Vector2F $texCoords,
    ): self
    {
        $self = new self($graphicsLib->ffi->new("sfVertex"));
        $self->setPosition($position);
        $self->setColor($color);
        $self->setTexCoords($texCoords);
        return $self;
    }

    public function setPosition(Vector2F $position): void
    {
        $this->cdata->position = $position->cdata;
    }

    public function setColor(Color $color): void
    {
        $this->cdata->color = $color->cdata;
    }

    public function setTexCoords(Vector2F $texCoords): void
    {
        $this->cdata->texCoords = $texCoords->cdata;
    }

    public function getPosition(): Vector2F
    {
        return $this->cdata->position;
    }

    public function getColor(): Color
    {
        return $this->cdata->color;
    }

    public function getTexCoords(): Vector2F
    {
        return $this->cdata->texCoords;
    }
}