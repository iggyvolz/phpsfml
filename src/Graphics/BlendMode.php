<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\Window\WindowLib;

readonly class BlendMode
{
    public function __construct(
        // sfBlendMode
        public CData $cdata
    )
    {
    }

    /**
     * @param BlendFactor $colorSrcFactor Source blending factor for the color channels
     * @param BlendFactor $colorDstFactor Destination blending factor for the color channels
     * @param BlendEquation $colorEquation Blending equation for the color channels
     * @param BlendFactor $alphaSrcFactor Source blending factor for the alpha channel
     * @param BlendFactor $alphaDstFactor Destination blending factor for the alpha channel
     * @param BlendEquation $alphaEquation Blending equation for the alpha channel
     */
    public function create(
        GraphicsLib $graphicsLib,
        BlendFactor $colorSrcFactor,
        BlendFactor $colorDstFactor,
        BlendEquation $colorEquation,
        BlendFactor $alphaSrcFactor,
        BlendFactor $alphaDstFactor,
        BlendEquation $alphaEquation,
    ): self {
        $self = new self($graphicsLib->ffi->new("sfBlendMode"));
        $self->setColorSrcFactor($colorSrcFactor);
        $self->setColorDstFactor($colorDstFactor);
        $self->setColorEquation($colorEquation);
        $self->setAlphaSrcFactor($alphaSrcFactor);
        $self->setAlphaDstFactor($alphaDstFactor);
        $self->setAlphaEquation($alphaEquation);
        return $self;
    }

    /**
     * @return BlendFactor Source blending factor for the color channels
     */
    public function getColorSrcFactor(): BlendFactor {
        return $this->cdata->colorSrcFactor;
    }
    /**
     * @param BlendFactor $colorSrcFactor Source blending factor for the color channels
     */
    public function setColorSrcFactor(BlendFactor $colorSrcFactor): void {
        $this->cdata->colorSrcFactor = $colorSrcFactor;
    }
    /**
     * @return BlendFactor Destination blending factor for the color channels
     */
    public function getColorDstFactor(): BlendFactor {
        return $this->cdata->colorDstFactor;
    }
    /**
     * @param BlendFactor $colorDstFactor Destination blending factor for the color channels
     */
    public function setColorDstFactor(BlendFactor $colorDstFactor): void {
        $this->cdata->colorDstFactor = $colorDstFactor;
    }
    /**
     * @return BlendEquation Blending equation for the color channels
     */
    public function getColorEquation(): BlendEquation {
        return $this->cdata->colorEquation;
    }
    /**
     * @param BlendEquation $colorEquation Blending equation for the color channels
     */
    public function setColorEquation(BlendEquation $colorEquation): void {
        $this->cdata->colorEquation = $colorEquation;
    }
    /**
     * @return BlendFactor Source blending factor for the alpha channel
     */
    public function getAlphaSrcFactor(): BlendFactor {
        return $this->cdata->alphaSrcFactor;
    }
    /**
     * @param BlendFactor $alphaSrcFactor Source blending factor for the alpha channel
     */
    public function setAlphaSrcFactor(BlendFactor $alphaSrcFactor): void {
        $this->cdata->alphaSrcFactor = $alphaSrcFactor;
    }
    /**
     * @return BlendFactor Destination blending factor for the alpha channel
     */
    public function getAlphaDstFactor(): BlendFactor {
        return $this->cdata->alphaDstFactor;
    }
    /**
     * @param BlendFactor $alphaDstFactor Destination blending factor for the alpha channel
     */
    public function setAlphaDstFactor(BlendFactor $alphaDstFactor): void {
        $this->cdata->alphaDstFactor = $alphaDstFactor;
    }
    /**
     * @return BlendEquation Blending equation for the alpha channel
     */
    public function getAlphaEquation(): BlendEquation {
        return $this->cdata->alphaEquation;
    }
    /**
     * @param BlendEquation $alphaEquation Blending equation for the alpha channel
     */
    public function setAlphaEquation(BlendEquation $alphaEquation): void {
        $this->cdata->alphaEquation = $alphaEquation;
    }

    /**
     * @return self Blend source and dest according to dest alpha
     */
    public static function getBlendAlpha(GraphicsLib $graphicsLib): self {
        return $graphicsLib->ffi->sfBlendAlpha;
    }

    /**
     * @return self Add source to dest
     */
    public static function getBlendAdd(GraphicsLib $graphicsLib): self {
        return $graphicsLib->ffi->sfBlendAdd;
    }

    /**
     * @return self Multiply source and dest
     */
    public static function getBlendMultiply(GraphicsLib $graphicsLib): self {
        return $graphicsLib->ffi->sfBlendMultiply;
    }

    /**
     * @return self Overwrite dest with source
     */
    public static function getBlendNone(GraphicsLib $graphicsLib): self {
        return $graphicsLib->ffi->sfBlendNone;
    }
}