<?php

namespace iggyvolz\SFML\System\Vector;


/**
 * 2-component vector of floats
 * @see System/Vector2.h
 * @deprecated
 */
class Vector2F
{
    #[\Spem("libphpsfml.so", "vector2f_construct")]
    public function __construct(float $x, float $y){

    }

    public float $x { #[\Spem("libphpsfml.so", "vector2f_getx")] get {}  #[\Spem("libphpsfml.so", "vector2f_setx")] set {}}
    public float $y { #[\Spem("libphpsfml.so", "vector2f_gety")] get {}  #[\Spem("libphpsfml.so", "vector2f_sety")] set {}}
}