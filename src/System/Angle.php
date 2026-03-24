<?php

namespace iggyvolz\SFML\System;

class Angle
{
    private function __construct(){}

    #[\Spem("angle_degrees")]
    public static function fromDegrees(float $degrees): self
    {

    }
    #[\Spem("angle_radians")]
    public static function fromRadians(float $radians): self
    {

    }

    public float $degrees { #[\Spem("angle_asDegrees")] get {}}
    public float $radians { #[\Spem("angle_asRadians")] get {}}

    #[\Spem("angle_destruct")]
    public function __destruct()
    {
    }

}