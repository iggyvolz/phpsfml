<?php

namespace iggyvolz\SFML\System\Vector;

/**
 * 2-component vector of integers
 * @see System/Vector2.h
 * @deprecated
 */
class Vector2I
{
    #[\Spem("libphpsfml.so", "vector2i_construct")]
    public function __construct(int $x, int $y){

    }

    public int $x { #[\Spem("libphpsfml.so", "vector2i_getx")] get {}  #[\Spem("libphpsfml.so", "vector2i_setx")] set {}}
    public int $y { #[\Spem("libphpsfml.so", "vector2i_gety")] get {}  #[\Spem("libphpsfml.so", "vector2i_sety")] set {}}
}