<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Utils\ISfmlObject;

interface Drawable
{
    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void;
}