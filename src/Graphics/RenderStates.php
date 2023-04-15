<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

#[CType("sfRenderStates")]
class RenderStates extends GraphicsObject
{
    public static function create(
        Sfml $sfml,
        Transform $transform,
        Texture $texture,
        Shader $shader,
    ): self
    {
        $self = static::newObject($sfml);
        $self->setTransform($transform);
        $self->setTexture($texture);
        $self->setShader($shader);
        return $self;
    }
    public static function default(Sfml $sfml): self
    {
        return new self($sfml, $sfml->graphics->ffi->sfRenderStates_default());
    }

    public function setTransform(Transform $transform): void
    {
        $this->cdata->transform = $transform->asGraphics();
    }
    public function getTransform(): Transform
    {
        return new Transform($this->sfml, $this->cdata->transform);
    }

    public function setTexture(Texture $texture): void
    {
        $this->cdata->texture = $texture->asGraphics();
    }
    public function getTexture(): Texture
    {
        return new Texture($this->sfml, $this->cdata->texture);
    }

    public function setShader(Shader $shader): void
    {
        $this->cdata->shader = $shader->asGraphics();
    }
    public function getShader(): Shader
    {
        return new Shader($this->sfml, $this->cdata->shader);
    }
}