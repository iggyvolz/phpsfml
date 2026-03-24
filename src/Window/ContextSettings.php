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
        #[\Spem("contextSettings_getDepthBits")] get {}
        #[\Spem("contextSettings_setDepthBits")] set {}
    }
    public int $stencilBits {
        #[\Spem("contextSettings_getStencilBits")] get {}
        #[\Spem("contextSettings_setStencilBits")] set {}
    }
    public int $antialiasingLevel {
        #[\Spem("contextSettings_getAntialiasingLevel")] get {}
        #[\Spem("contextSettings_setAntialiasingLevel")] set {}
    }
    public int $majorVersion {
        #[\Spem("contextSettings_getMajorVersion")] get {}
        #[\Spem("contextSettings_setMajorVersion")] set {}
    }
    public int $minorVersion {
        #[\Spem("contextSettings_getMinorVersion")] get {}
        #[\Spem("contextSettings_setMinorVersion")] set {}
    }
    public array $attributeFlags {
        #[\Spem("contextSettings_getAttributeFlags")] get {}
        #[\Spem("contextSettings_setAttributeFlags")] set {}
    }
    public bool $sRgbCapable {
        #[\Spem("contextSettings_getSRgbCapable")] get {}
        #[\Spem("contextSettings_setSRgbCapable")] set {}
    }
    #[\Spem("contextSettings_construct")]
    private function construct():void
    {
    }
    #[\Spem("contextSettings_destruct")]
    public function __destruct()
    {
    }
}