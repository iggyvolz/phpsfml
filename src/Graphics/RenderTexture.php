<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\System\Vector\Vector2I;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Utils\CType;
use iggyvolz\SFML\Window\ContextSettings;
#[CType("sfRenderWindow*")]
class RenderTexture extends GraphicsObject implements RenderTarget
{
    public static function create(Sfml $sfml, int $width, int $height, ?ContextSettings $settings = null): self
    {
        return new self($sfml, $sfml->graphics->ffi->sfRenderTexture_create($width, $height, ($settings ?? ContextSettings::create($sfml))->asGraphics()));
    }

    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfRenderTexture_destroy($this->cdata);
    }

    public function clear(?Color $color = null): void
    {
        $this->sfml->graphics->ffi->sfRenderTexture_clear($this->cdata, ($color ?? Color::createFromRGBA($this->sfml, 0, 0, 0, 255)));
    }

    public function setView(View $view): void
    {
        $this->sfml->graphics->ffi->sfRenderTexture_setView($this->cdata, $view->asGraphics());
    }

    public function getView(): View
    {
        return new View($this->sfml, $this->sfml->graphics->ffi->sfRenderTexture_getView($this->cdata));
    }

    public function getDefaultView(): View
    {
        return new View($this->sfml, $this->sfml->graphics->ffi->sfRenderTexture_getDefaultView($this->cdata));
    }

    public function getViewport(View $view): IntRect
    {
        return new IntRect($this->sfml, $this->sfml->graphics->ffi->sfRenderTexture_getViewport($this->cdata, $view->asGraphics()));
    }

    public function mapPixelToCoords(Vector2I $point, ?View $view = null): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfRenderTexture_mapPixelToCoords($this->cdata, $point->asGraphics(), $view?->asGraphics()), true);
    }

    public function mapCoordsToPixel(Vector2F $point, ?View $view = null): Vector2I
    {
        return new Vector2I($this->sfml, $this->sfml->graphics->ffi->sfRenderTexture_mapCoordsToPixel($this->cdata, $point->asGraphics(), $view?->asGraphics()), true);
    }

    public function draw(Drawable $drawable, ?RenderStates $renderStates = null): void
    {
        $drawable->draw($this, $renderStates);
    }

    public function getSize(): Vector2U
    {
        return new Vector2U($this->sfml, $this->sfml->graphics->ffi->sfRenderTexture_getSize($this->cdata), true);
    }

    public function setActive(bool $active = true): bool
    {
        return $this->sfml->graphics->ffi->sfRenderTexture_setActive($this->cdata, $active ? 1 : 0) === 1;
    }

    public function display(): void
    {
        $this->sfml->graphics->ffi->sfRenderTexture_display($this->cdata);
    }

    public function pushGLStates(): void
    {
        $this->sfml->graphics->ffi->sfRenderTexture_pushGLStates($this->cdata);
    }

    public function popGLStates(): void
    {
        $this->sfml->graphics->ffi->sfRenderTexture_popGLStates($this->cdata);
    }

    public function resetGLStates(): void
    {
        $this->sfml->graphics->ffi->sfRenderTexture_resetGLStates($this->cdata);
    }

    public function getTexture(): Texture
    {
        return new Texture($this->sfml, $this->sfml->graphics->ffi->sfRenderTexture_getTexture($this->cdata));
    }

    public function getMaximumAntialiasingLevel(): int
    {
        return $this->sfml->graphics->ffi->sfRenderTexture_getMaximumAntialiasingLevel($this->cdata);
    }

    public function setSmooth(bool $smooth): void
    {
        $this->sfml->graphics->ffi->sfRenderTexture_setSmooth($this->cdata, $smooth ? 1 : 0);
    }

    public function isSmooth(): bool
    {
        return $this->sfml->graphics->ffi->sfRenderTexture_isSmooth($this->cdata) === 1;
    }

    public function setRepeated(bool $smooth): void
    {
        $this->sfml->graphics->ffi->sfRenderTexture_setRepeated($this->cdata, $smooth ? 1 : 0);
    }

    public function isRepeated(): bool
    {
        return $this->sfml->graphics->ffi->sfRenderTexture_isRepeated($this->cdata) === 1;
    }

    public function generateMipmap(): bool
    {
        return $this->sfml->graphics->ffi->sfRenderTexture_generateMipmap($this->cdata) === 1;
    }
}