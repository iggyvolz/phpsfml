<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\System\Vector\Vector2I;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Window\ContextSettings;

readonly class RenderTexture implements RenderTarget
{
    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfRenderWindow*
        /** @internal  */
        public CData $cdata
    )
    {
    }
    public static function create(GraphicsLib $graphicsLib, int $width, int $height, ?ContextSettings $settings = null): self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfRenderTexture_create($width, $height, ($settings ?? ContextSettings::create($graphicsLib))->cdata));
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfRenderTexture_destroy($this->cdata);
    }

    public function clear(?Color $color = null): void
    {
        $this->graphicsLib->ffi->sfRenderTexture_clear($this->cdata, ($color ?? Color::createFromRGBA($this->graphicsLib, 0, 0, 0, 255)));
    }

    public function setView(View $view): void
    {
        $this->graphicsLib->ffi->sfRenderTexture_setView($this->cdata, $view->cdata);
    }

    public function getView(): View
    {
        return new View($this->graphicsLib, $this->graphicsLib->ffi->sfRenderTexture_getView($this->cdata));
    }

    public function getDefaultView(): View
    {
        return new View($this->graphicsLib, $this->graphicsLib->ffi->sfRenderTexture_getDefaultView($this->cdata));
    }

    public function getViewport(View $view): IntRect
    {
        return new IntRect($this->graphicsLib, $this->graphicsLib->ffi->sfRenderTexture_getViewport($this->cdata, $view->cdata));
    }

    public function mapPixelToCoords(Vector2I $point, ?View $view = null): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfRenderTexture_mapPixelToCoords($this->cdata, $point->cdata, $view?->cdata));
    }

    public function mapCoordsToPixel(Vector2F $point, ?View $view = null): Vector2I
    {
        return new Vector2I($this->graphicsLib->ffi->sfRenderTexture_mapCoordsToPixel($this->cdata, $point->cdata, $view?->cdata));
    }

    public function draw(Drawable $drawable, ?RenderStates $renderStates = null): void
    {
        $drawable->draw($this, $renderStates);
    }

    public function getSize(): Vector2U
    {
        return new Vector2U($this->graphicsLib->ffi->sfRenderTexture_getSize($this->cdata));
    }

    public function setActive(bool $active = true): bool
    {
        return $this->graphicsLib->ffi->sfRenderTexture_setActive($this->cdata, $active ? 1 : 0) === 1;
    }

    public function display(): void
    {
        $this->graphicsLib->ffi->sfRenderTexture_display($this->cdata);
    }

    public function pushGLStates(): void
    {
        $this->graphicsLib->ffi->sfRenderTexture_pushGLStates($this->cdata);
    }

    public function popGLStates(): void
    {
        $this->graphicsLib->ffi->sfRenderTexture_popGLStates($this->cdata);
    }

    public function resetGLStates(): void
    {
        $this->graphicsLib->ffi->sfRenderTexture_resetGLStates($this->cdata);
    }

    public function getTexture(): Texture
    {
        return new Texture($this->graphicsLib, $this->graphicsLib->ffi->sfRenderTexture_getTexture($this->cdata));
    }

    public function getMaximumAntialiasingLevel(): int
    {
        return $this->graphicsLib->ffi->sfRenderTexture_getMaximumAntialiasingLevel($this->cdata);
    }

    public function setSmooth(bool $smooth): void
    {
        $this->graphicsLib->ffi->sfRenderTexture_setSmooth($this->cdata, $smooth ? 1 : 0);
    }

    public function isSmooth(): bool
    {
        return $this->graphicsLib->ffi->sfRenderTexture_isSmooth($this->cdata) === 1;
    }

    public function setRepeated(bool $smooth): void
    {
        $this->graphicsLib->ffi->sfRenderTexture_setRepeated($this->cdata, $smooth ? 1 : 0);
    }

    public function isRepeated(): bool
    {
        return $this->graphicsLib->ffi->sfRenderTexture_isRepeated($this->cdata) === 1;
    }

    public function generateMipmap(): bool
    {
        return $this->graphicsLib->ffi->sfRenderTexture_generateMipmap($this->cdata) === 1;
    }
}