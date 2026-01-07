<?php

namespace iggyvolz\SFML\System\Vector;

/**
 * 3-component vector of floats
 * @see System/Vector3.h
 */
class Vector3F
{
    #[\Spem("libphpsfml.so", "vector3f_construct")]
    public function __construct(float $x, float $y){

    }

    public float $x { #[\Spem("libphpsfml.so", "vector3f_getx")] get {}  #[\Spem("libphpsfml.so", "vector3f_setx")] set {}}
    public float $y { #[\Spem("libphpsfml.so", "vector3f_gety")] get {}  #[\Spem("libphpsfml.so", "vector3f_sety")] set {}}
    public float $z { #[\Spem("libphpsfml.so", "vector3f_getz")] get {}  #[\Spem("libphpsfml.so", "vector3f_setz")] set {}}
}