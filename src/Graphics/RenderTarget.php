<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\System\Vector\Vector2I;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Utils\ISfmlObject;

interface RenderTarget extends ISfmlObject
{
    public function clear(?Color $color = null): void;
    public function setView(View $view): void;
    public function getView(): View;
    public function getViewport(View $view): IntRect;
    public function mapPixelToCoords(Vector2I $point, ?View $view = null): Vector2F;
    public function mapCoordsToPixel(Vector2F $point, ?View $view = null): Vector2I;
    public function draw(Drawable $drawable, ?RenderStates $renderStates = null): void;
    public function getSize(): Vector2U;
    public function setActive(bool $active = true): bool;
    public function pushGLStates(): void;
    public function popGLStates(): void;
    public function resetGLStates(): void;
}