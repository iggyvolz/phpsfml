<?php

namespace iggyvolz\SFML\Window;

enum CursorType: int
{
    /**
     * Arrow cursor (default)
     */
    case CursorArrow =  0;
    /**
     * Busy arrow cursor
     */
    case CursorArrowWait =  1;
    /**
     * Busy cursor
     */
    case CursorWait = 2;
    /**
     * I-beam
     */
    case CursorText = 3;
    /**
     * Pointing hand cursor
     */
    case CursorHand = 4;
    /**
     * Horizontal double arrow cursor
     */
    case CursorSizeHorizontal = 5;
    /**
     * Vertical double arrow cursor
     */
    case CursorSizeVertical = 6;
    /**
     * Double arrow cursor going from top-left to bottom-right
     */
    case CursorSizeTopLeftBottomRight = 7;
    /**
     * Double arrow cursor going from bottom-left to top-right
     */
    case CursorSizeBottomLeftTopRight = 8;
    /**
     * Combination of SizeHorizontal and SizeVertical
     */
    case CursorSizeAll = 9;
    /**
     * Crosshair cursor
     */
    case CursorCross = 10;
    /**
     * Help cursor
     */
    case CursorHelp = 11;
    /**
     * Action not allowed cursor
     */
    case CursorNotAllowed = 12;
}