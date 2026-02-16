<?php

namespace iggyvolz\SFML\System;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

class Angle
{
    private function __construct(){}

    #[\Spem("libphpsfml.so", "angle_degrees")]
    public static function fromDegrees(float $degrees): self
    {

    }
    #[\Spem("libphpsfml.so", "angle_radians")]
    public static function fromRadians(float $radians): self
    {

    }

    public float $degrees { #[\Spem("libphpsfml.so", "angle_asDegrees")] get {}}
    public float $radians { #[\Spem("libphpsfml.so", "angle_asRadians")] get {}}

    #[\Spem("libphpsfml.so", "angle_destruct")]
    public function __destruct()
    {
    }

}