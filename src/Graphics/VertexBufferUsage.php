<?php

namespace iggyvolz\SFML\Graphics;

enum VertexBufferUsage: int
{
    case Stream = 0;
    case Dynamic = 1;
    case Static = 2;
}