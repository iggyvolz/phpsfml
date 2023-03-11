<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\System\Vector\Vector2F;

interface Transformable
{
    public function setPosition(Vector2F $position): void;
    public function setRotation(float $angle): void;
    public function setScale(Vector2F $scale): void;
    public function setOrigin(Vector2F $origin): void;
    public function getPosition(): Vector2F;
    public function getRotation(): float;
    public function getScale(): Vector2F;
    public function getOrigin(): Vector2F;
    public function move(Vector2F $offset): void;
    public function rotate(float $offset): void;
    public function scale(Vector2F $offset): void;
    public function getTransform(): Transform;
    public function getInverseTransform(): Transform;
}