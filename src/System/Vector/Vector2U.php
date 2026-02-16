<?php

namespace iggyvolz\SFML\System\Vector;

/**
 * 2-component vector of unsigned integers
 * @see System/Vector2.h
 * @deprecated
 */
class Vector2U
{
    #[\Spem("libphpsfml.so", "vector2u_construct")]
    public function __construct(int $x, int $y){

    }

    public int $x { #[\Spem("libphpsfml.so", "vector2u_getx")] get {}  #[\Spem("libphpsfml.so", "vector2u_setx")] set {}}
    public int $y { #[\Spem("libphpsfml.so", "vector2u_gety")] get {}  #[\Spem("libphpsfml.so", "vector2u_sety")] set {}}
}