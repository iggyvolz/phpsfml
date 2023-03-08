<?php

namespace iggyvolz\SFML\Graphics;

enum BlendFactor: int
{
    /**
     * (0, 0, 0, 0)
     */
    case Zero = 0;
    /**
     * (1, 1, 1, 1)
     */
    case One = 1;
    /**
     * (src.r, src.g, src.b, src.a)
     */
    case SrcColor = 2;
    /**
     * (1, 1, 1, 1) - (src.r, src.g, src.b, src.a)
     */
    case OneMinusSrcColor = 3;
    /**
     * (dst.r, dst.g, dst.b, dst.a)
     */
    case DstColor = 4;
    /**
     * (1, 1, 1, 1) - (dst.r, dst.g, dst.b, dst.a)
     */
    case OneMinusDstColor = 5;
    /**
     * (src.a, src.a, src.a, src.a)
     */
    case SrcAlpha = 6;
    /**
     * (1, 1, 1, 1) - (src.a, src.a, src.a, src.a)
     */
    case OneMinusSrcAlpha = 7;
    /**
     * (dst.a, dst.a, dst.a, dst.a)
     */
    case DstAlpha = 8;
    /**
     * (1, 1, 1, 1) - (dst.a, dst.a, dst.a, dst.a)
     */
    case OneMinusDstAlpha = 9;
}
