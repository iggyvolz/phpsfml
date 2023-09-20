<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\Utils\CType;

#[CType("sfVertex")]
class Vertex extends GraphicsObject
{
    public static function create(
        Sfml $sfml,
        Vector2F $position,
        Color $color,
        Vector2F $texCoords,
    ): self
    {
        $self = static::newObject($sfml);
        $self->setPosition($position);
        $self->setColor($color);
        $self->setTexCoords($texCoords);
        return $self;
    }

    public function setPosition(Vector2F $position): void
    {
        $this->cdata->position = $position->asGraphics();
    }

    public function setColor(Color $color): void
    {
        $this->cdata->color = $color->asGraphics();
    }

    public function setTexCoords(Vector2F $texCoords): void
    {
        $this->cdata->texCoords = $texCoords->asGraphics();
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