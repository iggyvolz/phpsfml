<?php

namespace iggyvolz\SFML\Window;

final class ContextSettings
{
    public function __construct(
        int $depthBits = 0,
        int $stencilBits = 0,
        int $antialiasingLevel = 0,
        int $majorVersion = 1,
        int $minorVersion = 1,
        array $attributeFlags = ContextAttribute::default,
        bool $sRgbCapable = false,
    )
    {
        $this->construct();
        $this->depthBits = $depthBits;
        $this->stencilBits = $stencilBits;
        $this->antialiasingLevel = $antialiasingLevel;
        $this->majorVersion = $majorVersion;
        $this->minorVersion = $minorVersion;
        $this->attributeFlags = $attributeFlags;
        $this->sRgbCapable = $sRgbCapable;
    }

    public int $depthBits {
        #[\Spem("libphpsfml.so", "contextSettings_getDepthBits")] get {}
        #[\Spem("libphpsfml.so", "contextSettings_setDepthBits")] set {}
    }
    public int $stencilBits {
        #[\Spem("libphpsfml.so", "contextSettings_getStencilBits")] get {}
        #[\Spem("libphpsfml.so", "contextSettings_setStencilBits")] set {}
    }
    public int $antialiasingLevel {
        #[\Spem("libphpsfml.so", "contextSettings_getAntialiasingLevel")] get {}
        #[\Spem("libphpsfml.so", "contextSettings_setAntialiasingLevel")] set {}
    }
    public int $majorVersion {
        #[\Spem("libphpsfml.so", "contextSettings_getMajorVersion")] get {}
        #[\Spem("libphpsfml.so", "contextSettings_setMajorVersion")] set {}
    }
    public int $minorVersion {
        #[\Spem("libphpsfml.so", "contextSettings_getMinorVersion")] get {}
        #[\Spem("libphpsfml.so", "contextSettings_setMinorVersion")] set {}
    }
    public array $attributeFlags {
        #[\Spem("libphpsfml.so", "contextSettings_getAttributeFlags")] get {}
        #[\Spem("libphpsfml.so", "contextSettings_setAttributeFlags")] set {}
    }
    public bool $sRgbCapable {
        #[\Spem("libphpsfml.so", "contextSettings_getSRgbCapable")] get {}
        #[\Spem("libphpsfml.so", "contextSettings_setSRgbCapable")] set {}
    }
    #[\Spem("libphpsfml.so", "contextSettings_construct")]
    private function construct():void
    {
    }
    #[\Spem("libphpsfml.so", "contextSettings_destruct")]
    public function __destruct()
    {
    }
}