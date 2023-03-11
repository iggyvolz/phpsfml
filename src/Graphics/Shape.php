<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\System\Vector\Vector2F;

interface Shape extends Drawable, Transformable
{
    public function setTexture(Texture $texture, bool $resetRect = false): void;
    public function setTextureRect(IntRect $rect): void;
    public function setFillColor(Color $color): void;
    public function setOutlineColor(Color $color): void;
    public function setOutlineThickness(float $thickness): void;
    public function getTexture(): Texture;
    public function getTextureRect(): IntRect;
    public function getFillColor(): Color;
    public function getOutlineColor(): Color;
    public function getOutlineThickness(): float;
    public function getPointCount(): int;
    public function getPoint(int $i): Vector2F;
    public function getLocalBounds(): FloatRect;
    public function getGlobalBounds(): FloatRect;
}