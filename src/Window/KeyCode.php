<?php

namespace iggyvolz\SFML\Window;

enum KeyCode: int
{
    /**
     * Unhandled key
     */
    case Unknown = -1;
    /**
     * The A key
     */
    case A = 0;
    /**
     * The B key
     */
    case B = 1;
    /**
     * The C key
     */
    case C = 2;
    /**
     * The D key
     */
    case D = 3;
    /**
     * The E key
     */
    case E = 4;
    /**
     * The F key
     */
    case F = 5;
    /**
     * The G key
     */
    case G = 6;
    /**
     * The H key
     */
    case H = 7;
    /**
     * The I key
     */
    case I = 8;
    /**
     * The J key
     */
    case J = 9;
    /**
     * The K key
     */
    case K = 10;
    /**
     * The L key
     */
    case L = 11;
    /**
     * The M key
     */
    case M = 12;
    /**
     * The N key
     */
    case N = 13;
    /**
     * The O key
     */
    case O = 14;
    /**
     * The P key
     */
    case P = 15;
    /**
     * The Q key
     */
    case Q = 16;
    /**
     * The R key
     */
    case R = 17;
    /**
     * The S key
     */
    case S = 18;
    /**
     * The T key
     */
    case T = 19;
    /**
     * The U key
     */
    case U = 20;
    /**
     * The V key
     */
    case V = 21;
    /**
     * The W key
     */
    case W = 22;
    /**
     * The X key
     */
    case X = 23;
    /**
     * The Y key
     */
    case Y = 24;
    /**
     * The Z key
     */
    case Z = 25;
    /**
     * The 0 key
     */
    case Num0 = 26;
    /**
     * The 1 key
     */
    case Num1 = 27;
    /**
     * The 2 key
     */
    case Num2 = 28;
    /**
     * The 3 key
     */
    case Num3 = 29;
    /**
     * The 4 key
     */
    case Num4 = 30;
    /**
     * The 5 key
     */
    case Num5 = 31;
    /**
     * The 6 key
     */
    case Num6 = 32;
    /**
     * The 7 key
     */
    case Num7 = 33;
    /**
     * The 8 key
     */
    case Num8 = 34;
    /**
     * The 9 key
     */
    case Num9 = 35;
    /**
     * The Escape key
     */
    case Escape = 36;
    /**
     * The left Control key
     */
    case LControl = 37;
    /**
     * The left Shift key
     */
    case LShift = 38;
    /**
     * The left Alt key
     */
    case LAlt = 39;
    /**
     * The left OS specific key: window (Windows and Linux), apple (MacOS X), ...
     */
    case LSystem = 40;
    /**
     * The right Control key
     */
    case RControl = 41;
    /**
     * The right Shift key
     */
    case RShift = 42;
    /**
     * The right Alt key
     */
    case RAlt = 43;
    /**
     * The right OS specific key: window (Windows and Linux), apple (MacOS X), ...
     */
    case RSystem = 44;
    /**
     * The Menu key
     */
    case Menu = 45;
    /**
     * The [ key
     */
    case LBracket = 46;
    /**
     * The ] key
     */
    case RBracket = 47;
    /**
     * The ; key
     */
    case Semicolon = 48;
    /**
     * The , key
     */
    case Comma = 49;
    /**
     * The . key
     */
    case Period = 50;
    /**
     * The ' key
     */
    case Quote = 51;
    /**
     * The / key
     */
    case Slash = 52;
    /**
     * The \ key
     */
    case Backslash = 53;
    /**
     * The ~ key
     */
    case Tilde = 54;
    /**
     * The = key
     */
    case Equal = 55;
    /**
     * The - key (hyphen)
     */
    case Hyphen = 56;
    /**
     * The Space key
     */
    case Space = 57;
    /**
     * The Enter/Return key
     */
    case Enter = 58;
    /**
     * The Backspace key
     */
    case Backspace = 59;
    /**
     * The Tabulation key
     */
    case Tab = 60;
    /**
     * The Page up key
     */
    case PageUp = 61;
    /**
     * The Page down key
     */
    case PageDown = 62;
    /**
     * The End key
     */
    case End = 63;
    /**
     * The Home key
     */
    case Home = 64;
    /**
     * The Insert key
     */
    case Insert = 65;
    /**
     * The Delete key
     */
    case Delete = 66;
    /**
     * The + key
     */
    case Add = 67;
    /**
     * The - key (minus, usually from numpad)
     */
    case Subtract = 68;
    /**
     * The * key
     */
    case Multiply = 69;
    /**
     * The / key
     */
    case Divide = 70;
    /**
     * Left arrow
     */
    case Left = 71;
    /**
     * Right arrow
     */
    case Right = 72;
    /**
     * Up arrow
     */
    case Up = 73;
    /**
     * Down arrow
     */
    case Down = 74;
    /**
     * The numpad 0 key
     */
    case Numpad0 = 75;
    /**
     * The numpad 1 key
     */
    case Numpad1 = 76;
    /**
     * The numpad 2 key
     */
    case Numpad2 = 77;
    /**
     * The numpad 3 key
     */
    case Numpad3 = 78;
    /**
     * The numpad 4 key
     */
    case Numpad4 = 79;
    /**
     * The numpad 5 key
     */
    case Numpad5 = 80;
    /**
     * The numpad 6 key
     */
    case Numpad6 = 81;
    /**
     * The numpad 7 key
     */
    case Numpad7 = 82;
    /**
     * The numpad 8 key
     */
    case Numpad8 = 83;
    /**
     * The numpad 9 key
     */
    case Numpad9 = 84;
    /**
     * The F1 key
     */
    case F1 = 85;
    /**
     * The F2 key
     */
    case F2 = 86;
    /**
     * The F3 key
     */
    case F3 = 87;
    /**
     * The F4 key
     */
    case F4 = 88;
    /**
     * The F5 key
     */
    case F5 = 89;
    /**
     * The F6 key
     */
    case F6 = 90;
    /**
     * The F7 key
     */
    case F7 = 91;
    /**
     * The F8 key
     */
    case F8 = 92;
    /**
     * The F8 key
     */
    case F9 = 93;
    /**
     * The F10 key
     */
    case F10 = 94;
    /**
     * The F11 key
     */
    case F11 = 95;
    /**
     * The F12 key
     */
    case F12 = 96;
    /**
     * The F13 key
     */
    case F13 = 97;
    /**
     * The F14 key
     */
    case F14 = 98;
    /**
     * The F15 key
     */
    case F15 = 99;
    /**
     * The Pause key
     */
    case Pause = 100;
}
