<?php

namespace iggyvolz\SFML\Window;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

/**
 * Structure defining the window's creation settings
 */
#[CType("sfContextSettings")]
class ContextSettings extends WindowObject
{
    /**
     * @param list<ContextAttribute> $contextAttributes
     */
    public static function create(
        Sfml $sfml,
        int $depthBits = 0,
        int $stencilBits = 0,
        int $antialiasingLevel = 0,
        int $majorVersion = 1,
        int $minorVersion = 1,
        array $contextAttributes = ContextAttribute::default,
        bool $srgbCapable = false,
    ): self{
        $self = static::newObject($sfml);
        $self->setDepthBits($depthBits);
        $self->setStencilBits($stencilBits);
        $self->setAntialiasingLevel($antialiasingLevel);
        $self->setMajorVersion($majorVersion);
        $self->setMinorVersion($minorVersion);
        $self->setAttributeFlags(...$contextAttributes);
        $self->setSrgbCapable($srgbCapable);
        return $self;
    }

    /**
     * @return int Bits of the depth buffer
     */
    public function getDepthBits(): int
    {
        return $this->cdata->depthBits;
    }

    /**
     * @param int $value Bits of the depth buffer
     * @return void
     */
    public function setDepthBits(int $value): void
    {
        $this->cdata->depthBits = $value;
    }

    /**
     * @return int Bits of the stencil buffer
     */
    public function getStencilBits(): int
    {
        return $this->cdata->stencilBits;
    }

    /**
     * @param int $value Bits of the stencil buffer
     * @return void
     */
    public function setStencilBits(int $value): void
    {
        $this->cdata->stencilBits = $value;
    }

    /**
     * @return int Level of antialiasing
     */
    public function getAntialiasingLevel(): int
    {
        return $this->cdata->antialiasingLevel;
    }

    /**
     * @param int $value Level of antialiasing
     * @return void
     */
    public function setAntialiasingLevel(int $value): void
    {
        $this->cdata->antialiasingLevel = $value;
    }

    /**
     * @return int Major number of the context version to create
     */
    public function getMajorVersion(): int
    {
        return $this->cdata->majorVersion;
    }

    /**
     * @param int $value Major number of the context version to create
     * @return void
     */
    public function setMajorVersion(int $value): void
    {
        $this->cdata->majorVersion = $value;
    }

    /**
     * @return int Minor number of the context version to create
     */
    public function getMinorVersion(): int
    {
        return $this->cdata->minorVersion;
    }

    /**
     * @param int $value Minor number of the context version to create
     * @return void
     */
    public function setMinorVersion(int $value): void
    {
        $this->cdata->minorVersion = $value;
    }

    /**
     * @return list<ContextAttribute> The attribute flags to create the context with
     */
    public function getAttributeFlags(): array
    {
        return ContextAttribute::fromInt($this->cdata->attributeFlags);
    }

    /**
     * @param list<ContextAttribute> $value The attribute flags to create the context with
     * @return void
     */
    public function setAttributeFlags(ContextAttribute ...$value): void
    {
        $this->cdata->attributeFlags = ContextAttribute::toInt(...$value);
    }

    /**
     * @return bool Whether the context framebuffer is sRGB capable
     */
    public function getSrgbCapable(): bool
    {
        return $this->cdata->sRgbCapable === 1;
    }

    /**
     * @param bool $value Whether the context framebuffer is sRGB capable
     * @return void
     */
    public function setSrgbCapable(bool $value): void
    {
        $this->cdata->sRgbCapable = $value?1:0;
    }
}