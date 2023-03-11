<?php

namespace iggyvolz\SFML\Graphics;

interface Drawable
{
    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void;
}