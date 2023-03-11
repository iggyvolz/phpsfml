<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;

class RenderStates
{
    public function __construct(
        public readonly GraphicsLib $graphicsLib,
        // sfRenderStates
        /**
         * @internal
         */
        public CData $cdata,
    )
    {
    }
    public function create(
        GraphicsLib $graphicsLib,
        Transform $transform,
        Texture $texture,
        Shader $shader,
    ): self
    {
        $obj = $graphicsLib->ffi->new("sfRenderStates");
        $this->setTransform($transform);
        $this->setTexture($texture);
        $this->setShader($shader);
        return new self($graphicsLib, $obj);
    }
    public static function default(GraphicsLib $graphicsLib): self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfRenderStates_default());
    }

    public function setTransform(Transform $transform): void
    {
        $this->cdata->transform = $transform->cdata;
    }
    public function getTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->cdata->transform);
    }

    public function setTexture(Texture $texture): void
    {
        $this->cdata->texture = $texture->cdata;
    }
    public function getTexture(): Texture
    {
        return new Texture($this->graphicsLib, $this->cdata->texture);
    }

    public function setShader(Shader $shader): void
    {
        $this->cdata->shader = $shader->cdata;
    }
    public function getShader(): Shader
    {
        return new Shader($this->graphicsLib, $this->cdata->shader);
    }
}