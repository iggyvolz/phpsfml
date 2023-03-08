<?php

namespace iggyvolz\SFML\Graphics;

enum BlendEquation: int
{
    /**
     * Pixel = Src * SrcFactor + Dst * DstFactor
     */
    case Add = 0;
    /**
     * Pixel = Src * SrcFactor - Dst * DstFactor
     */
    case Subtract = 1;
    /**
     * Pixel = Dst * DstFactor - Src * SrcFactor
     */
    case ReverseSubtract = 2;
}
