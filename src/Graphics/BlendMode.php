<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

#[CType("sfBlendMode")]
class BlendMode extends GraphicsObject
{
    /**
     * @param BlendFactor $colorSrcFactor Source blending factor for the color channels
     * @param BlendFactor $colorDstFactor Destination blending factor for the color channels
     * @param BlendEquation $colorEquation Blending equation for the color channels
     * @param BlendFactor $alphaSrcFactor Source blending factor for the alpha channel
     * @param BlendFactor $alphaDstFactor Destination blending factor for the alpha channel
     * @param BlendEquation $alphaEquation Blending equation for the alpha channel
     */
    public function create(
        Sfml $sfml,
        BlendFactor $colorSrcFactor,
        BlendFactor $colorDstFactor,
        BlendEquation $colorEquation,
        BlendFactor $alphaSrcFactor,
        BlendFactor $alphaDstFactor,
        BlendEquation $alphaEquation,
    ): self {
        $self = static::newObject($sfml);
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
        return BlendFactor::from($this->cdata->colorSrcFactor);
    }
    /**
     * @param BlendFactor $colorSrcFactor Source blending factor for the color channels
     */
    public function setColorSrcFactor(BlendFactor $colorSrcFactor): void {
        $this->cdata->colorSrcFactor = $colorSrcFactor->value;
    }
    /**
     * @return BlendFactor Destination blending factor for the color channels
     */
    public function getColorDstFactor(): BlendFactor {
        return BlendFactor::from($this->cdata->colorDstFactor);
    }
    /**
     * @param BlendFactor $colorDstFactor Destination blending factor for the color channels
     */
    public function setColorDstFactor(BlendFactor $colorDstFactor): void {
        $this->cdata->colorDstFactor = $colorDstFactor->value;
    }
    /**
     * @return BlendEquation Blending equation for the color channels
     */
    public function getColorEquation(): BlendEquation {
        return BlendEquation::from($this->cdata->colorEquation);
    }
    /**
     * @param BlendEquation $colorEquation Blending equation for the color channels
     */
    public function setColorEquation(BlendEquation $colorEquation): void {
        $this->cdata->colorEquation = $colorEquation->value;
    }
    /**
     * @return BlendFactor Source blending factor for the alpha channel
     */
    public function getAlphaSrcFactor(): BlendFactor {
        return BlendFactor::from($this->cdata->alphaSrcFactor);
    }
    /**
     * @param BlendFactor $alphaSrcFactor Source blending factor for the alpha channel
     */
    public function setAlphaSrcFactor(BlendFactor $alphaSrcFactor): void {
        $this->cdata->alphaSrcFactor = $alphaSrcFactor->value;
    }
    /**
     * @return BlendFactor Destination blending factor for the alpha channel
     */
    public function getAlphaDstFactor(): BlendFactor {
        return BlendFactor::from($this->cdata->alphaDstFactor);
    }
    /**
     * @param BlendFactor $alphaDstFactor Destination blending factor for the alpha channel
     */
    public function setAlphaDstFactor(BlendFactor $alphaDstFactor): void {
        $this->cdata->alphaDstFactor = $alphaDstFactor->value;
    }
    /**
     * @return BlendEquation Blending equation for the alpha channel
     */
    public function getAlphaEquation(): BlendEquation {
        return BlendEquation::from($this->cdata->alphaEquation);
    }
    /**
     * @param BlendEquation $alphaEquation Blending equation for the alpha channel
     */
    public function setAlphaEquation(BlendEquation $alphaEquation): void {
        $this->cdata->alphaEquation = $alphaEquation->value;
    }

    /**
     * @return self Blend source and dest according to dest alpha
     */
    public static function getBlendAlpha(Sfml $sfml): self {
        return new self($sfml, $sfml->graphics->ffi->sfBlendAlpha);
    }

    /**
     * @return self Add source to dest
     */
    public static function getBlendAdd(Sfml $sfml): self {
        return new self($sfml, $sfml->graphics->ffi->sfBlendAdd);
    }

    /**
     * @return self Multiply source and dest
     */
    public static function getBlendMultiply(Sfml $sfml): self {
        return new self($sfml, $sfml->graphics->ffi->sfBlendMultiply);
    }

    /**
     * @return self Overwrite dest with source
     */
    public static function getBlendNone(Sfml $sfml): self {
        return new self($sfml, $sfml->graphics->ffi->sfBlendNone);
    }
}