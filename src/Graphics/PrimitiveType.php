<?php

namespace iggyvolz\SFML\Graphics;

enum PrimitiveType: int
{
    /**
     * List of individual points
     */
    case Points = 0;
    /**
     * List of individual lines
     */
    case Lines = 1;
    /**
     * List of connected lines, a point uses the previous point to form a line
     */
    case LineStrip = 2;
    /**
     * List of individual triangles
     */
    case Triangles = 3;
    /**
     * List of connected triangles, a point uses the two previous points to form a triangle
     */
    case TriangleStrip = 4;
    /**
     * List of connected triangles, a point uses the common center and the previous point to form a triangle
     */
    case TriangleFan = 5;
    /**
     * List of individual quads
     */
    case Quads = 6;
}
