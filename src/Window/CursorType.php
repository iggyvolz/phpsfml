<?php

namespace iggyvolz\SFML\Window;

enum CursorType: int
{
    /**
     * Arrow cursor (default)
     */
    case Arrow = 0;
    /**
     * Busy arrow cursor
     */
    case ArrowWait = 1;
    /**
     * Busy cursor
     */
    case Wait = 2;
    /**
     * I-beam, cursor when hovering over a field allowing text entry
     */
    case Text = 3;
    /**
     * Pointing hand cursor
     */
    case Hand = 4;
    /**
     * Horizontal double arrow cursor
     */
    case SizeHorizontal = 5;
    /**
     * Vertical double arrow cursor
     */
    case SizeVertical = 6;
    /**
     * Double arrow cursor going from top-left to bottom-right
     */
    case SizeTopLeftBottomRight = 7;
    /**
     * Double arrow cursor going from bottom-left to top-right
     */
    case SizeBottomLeftTopRight = 8;
    /**
     * Left arrow cursor on Linux, same as SizeHorizontal on other platforms
     */
    case SizeLeft = 9;
    /**
     * Right arrow cursor on Linux, same as SizeHorizontal on other platforms
     */
    case SizeRight = 10;
    /**
     * Up arrow cursor on Linux, same as SizeVertical on other platforms
     */
    case SizeTop = 11;
    /**
     * Down arrow cursor on Linux, same as SizeVertical on other platforms
     */
    case SizeBottom = 12;
    /**
     * Top-left arrow cursor on Linux, same as SizeTopLeftBottomRight on other platforms
     */
    case SizeTopLeft = 13;
    /**
     * Bottom-right arrow cursor on Linux, same as SizeTopLeftBottomRight on other platforms
     */
    case SizeBottomRight = 14;
    /**
     * Bottom-left arrow cursor on Linux, same as SizeBottomLeftTopRight on other platforms
     */
    case SizeBottomLeft = 15;
    /**
     * Top-right arrow cursor on Linux, same as SizeBottomLeftTopRight on other platforms
     */
    case SizeTopRight = 16;
    /**
     * Combination of SizeHorizontal and SizeVertical
     */
    case SizeAll = 17;
    /**
     * Crosshair cursor
     */
    case Cross = 18;
    /**
     * Help cursor
     */
    case Help = 19;
    /**
     * Action not allowed cursor
     */
    case NotAllowed = 20;
}