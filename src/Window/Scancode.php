<?php

namespace iggyvolz\SFML\Window;

use Spem;

enum Scancode: int
{
    /**
     * Represents any scancode not present in this enum.
     */
    case Unknown = -1;
    /**
     * Keyboard a and A key.
     */
    case A = 0;
    /**
     * Keyboard b and B key.
     */
    case B = 1;
    /**
     * Keyboard c and C key.
     */
    case C = 2;
    /**
     * Keyboard d and D key.
     */
    case D = 3;
    /**
     * Keyboard e and E key.
     */
    case E = 4;
    /**
     * Keyboard f and F key.
     */
    case F = 5;
    /**
     * Keyboard g and G key.
     */
    case G = 6;
    /**
     * Keyboard h and H key.
     */
    case H = 7;
    /**
     * Keyboard i and I key.
     */
    case I = 8;
    /**
     * Keyboard j and J key.
     */
    case J = 9;
    /**
     * Keyboard k and K key.
     */
    case K = 10;
    /**
     * Keyboard l and L key.
     */
    case L = 11;
    /**
     * Keyboard m and M key.
     */
    case M = 12;
    /**
     * Keyboard n and N key.
     */
    case N = 13;
    /**
     * Keyboard o and O key.
     */
    case O = 14;
    /**
     * Keyboard p and P key.
     */
    case P = 15;
    /**
     * Keyboard q and Q key.
     */
    case Q = 16;
    /**
     * Keyboard r and R key.
     */
    case R = 17;
    /**
     * Keyboard s and S key.
     */
    case S = 18;
    /**
     * Keyboard t and T key.
     */
    case T = 19;
    /**
     * Keyboard u and U key.
     */
    case U = 20;
    /**
     * Keyboard v and V key.
     */
    case V = 21;
    /**
     * Keyboard w and W key.
     */
    case W = 22;
    /**
     * Keyboard x and X key.
     */
    case X = 23;
    /**
     * Keyboard y and Y key.
     */
    case Y = 24;
    /**
     * Keyboard z and Z key.
     */
    case Z = 25;
    /**
     * Keyboard 1 and ! key.
     */
    case Num1 = 26;
    /**
     * Keyboard 2 and @ key.
     */
    case Num2 = 27;
    /**
     * Keyboard 3 and # key.
     */
    case Num3 = 28;
    /**
     * Keyboard 4 and $ key.
     */
    case Num4 = 29;
    /**
     * Keyboard 5 and % key.
     */
    case Num5 = 30;
    /**
     * Keyboard 6 and ^ key.
     */
    case Num6 = 31;
    /**
     * Keyboard 7 and & key.
     */
    case Num7 = 32;
    /**
     * Keyboard 8 and * key.
     */
    case Num8 = 33;
    /**
     * Keyboard 9 and ) key.
     */
    case Num9 = 34;
    /**
     * Keyboard 0 and ) key.
     */
    case Num0 = 35;
    /**
     * Keyboard Enter/Return key.
     */
    case Enter = 36;
    /**
     * Keyboard Escape key.
     */
    case Escape = 37;
    /**
     * Keyboard Backspace key.
     */
    case Backspace = 38;
    /**
     * Keyboard Tab key.
     */
    case Tab = 39;
    /**
     * Keyboard Space key.
     */
    case Space = 40;
    /**
     * Keyboard - and _ key.
     */
    case Hyphen = 41;
    /**
     * Keyboard = and +.
     */
    case Equal = 42;
    /**
     * Keyboard [ and { key.
     */
    case LBracket = 43;
    /**
     * Keyboard ] and } key.
     */
    case RBracket = 44;
    /**
     * Keyboard \ and | key OR various keys for Non-US keyboards.
     */
    case Backslash = 45;
    /**
     * Keyboard ; and : key.
     */
    case Semicolon = 46;
    /**
     * Keyboard ' and " key.
     */
    case Apostrophe = 47;
    /**
     * Keyboard ` and ~ key.
     */
    case Grave = 48;
    /**
     * Keyboard , and < key.
     */
    case Comma = 49;
    /**
     * Keyboard . and > key.
     */
    case Period = 50;
    /**
     * Keyboard / and ? key.
     */
    case Slash = 51;
    /**
     * Keyboard F1 key.
     */
    case F1 = 52;
    /**
     * Keyboard F2 key.
     */
    case F2 = 53;
    /**
     * Keyboard F3 key.
     */
    case F3 = 54;
    /**
     * Keyboard F4 key.
     */
    case F4 = 55;
    /**
     * Keyboard F5 key.
     */
    case F5 = 56;
    /**
     * Keyboard F6 key.
     */
    case F6 = 57;
    /**
     * Keyboard F7 key.
     */
    case F7 = 58;
    /**
     * Keyboard F8 key.
     */
    case F8 = 59;
    /**
     * Keyboard F9 key.
     */
    case F9 = 60;
    /**
     * Keyboard F10 key.
     */
    case F10 = 61;
    /**
     * Keyboard F11 key.
     */
    case F11 = 62;
    /**
     * Keyboard F12 key.
     */
    case F12 = 63;
    /**
     * Keyboard F13 key.
     */
    case F13 = 64;
    /**
     * Keyboard F14 key.
     */
    case F14 = 65;
    /**
     * Keyboard F15 key.
     */
    case F15 = 66;
    /**
     * Keyboard F16 key.
     */
    case F16 = 67;
    /**
     * Keyboard F17 key.
     */
    case F17 = 68;
    /**
     * Keyboard F18 key.
     */
    case F18 = 69;
    /**
     * Keyboard F19 key.
     */
    case F19 = 70;
    /**
     * Keyboard F20 key.
     */
    case F20 = 71;
    /**
     * Keyboard F21 key.
     */
    case F21 = 72;
    /**
     * Keyboard F22 key.
     */
    case F22 = 73;
    /**
     * Keyboard F23 key.
     */
    case F23 = 74;
    /**
     * Keyboard F24 key.
     */
    case F24 = 75;
    /**
     * Keyboard Caps Lock key.
     */
    case CapsLock = 76;
    /**
     * Keyboard Print Screen key.
     */
    case PrintScreen = 77;
    /**
     * Keyboard Scroll Lock key.
     */
    case ScrollLock = 78;
    /**
     * Keyboard Pause key.
     */
    case Pause = 79;
    /**
     * Keyboard Insert key.
     */
    case Insert = 80;
    /**
     * Keyboard Home key.
     */
    case Home = 81;
    /**
     * Keyboard Page Up key.
     */
    case PageUp = 82;
    /**
     * Keyboard Delete Forward key.
     */
    case Delete = 83;
    /**
     * Keyboard End key.
     */
    case End = 84;
    /**
     * Keyboard Page Down key.
     */
    case PageDown = 85;
    /**
     * Keyboard Right Arrow key.
     */
    case Right = 86;
    /**
     * Keyboard Left Arrow key.
     */
    case Left = 87;
    /**
     * Keyboard Down Arrow key.
     */
    case Down = 88;
    /**
     * Keyboard Up Arrow key.
     */
    case Up = 89;
    /**
     * Keypad Num Lock and Clear key.
     */
    case NumLock = 90;
    /**
     * Keypad / key.
     */
    case NumpadDivide = 91;
    /**
     * Keypad * key.
     */
    case NumpadMultiply = 92;
    /**
     * Keypad - key.
     */
    case NumpadMinus = 93;
    /**
     * Keypad + key.
     */
    case NumpadPlus = 94;
    /**
     * keypad = key
     */
    case NumpadEqual = 95;
    /**
     * Keypad Enter/Return key.
     */
    case NumpadEnter = 96;
    /**
     * Keypad . and Delete key.
     */
    case NumpadDecimal = 97;
    /**
     * Keypad 1 and End key.
     */
    case Numpad1 = 98;
    /**
     * Keypad 2 and Down Arrow key.
     */
    case Numpad2 = 99;
    /**
     * Keypad 3 and Page Down key.
     */
    case Numpad3 = 100;
    /**
     * Keypad 4 and Left Arrow key.
     */
    case Numpad4 = 101;
    /**
     * Keypad 5 key.
     */
    case Numpad5 = 102;
    /**
     * Keypad 6 and Right Arrow key.
     */
    case Numpad6 = 103;
    /**
     * Keypad 7 and Home key.
     */
    case Numpad7 = 104;
    /**
     * Keypad 8 and Up Arrow key.
     */
    case Numpad8 = 105;
    /**
     * Keypad 9 and Page Up key.
     */
    case Numpad9 = 106;
    /**
     * Keypad 0 and Insert key.
     */
    case Numpad0 = 107;
    /**
     * Keyboard Non-US \ and | key.
     */
    case NonUsBackslash = 108;
    /**
     * Keyboard Application key.
     */
    case Application = 109;
    /**
     * Keyboard Execute key.
     */
    case Execute = 110;
    /**
     * Keyboard Mode Change key.
     */
    case ModeChange = 111;
    /**
     * Keyboard Help key.
     */
    case Help = 112;
    /**
     * Keyboard Menu key.
     */
    case Menu = 113;
    /**
     * Keyboard Select key.
     */
    case Select = 114;
    /**
     * Keyboard Redo key.
     */
    case Redo = 115;
    /**
     * Keyboard Undo key.
     */
    case Undo = 116;
    /**
     * Keyboard Cut key.
     */
    case Cut = 117;
    /**
     * Keyboard Copy key.
     */
    case Copy = 118;
    /**
     * Keyboard Paste key.
     */
    case Paste = 119;
    /**
     * Keyboard Volume Mute key.
     */
    case VolumeMute = 120;
    /**
     * Keyboard Volume Up key.
     */
    case VolumeUp = 121;
    /**
     * Keyboard Volume Down key.
     */
    case VolumeDown = 122;
    /**
     * Keyboard Media Play Pause key.
     */
    case MediaPlayPause = 123;
    /**
     * Keyboard Media Stop key.
     */
    case MediaStop = 124;
    /**
     * Keyboard Media Next Track key.
     */
    case MediaNextTrack = 125;
    /**
     * Keyboard Media Previous Track key.
     */
    case MediaPreviousTrack = 126;
    /**
     * Keyboard Left Control key.
     */
    case LControl = 127;
    /**
     * Keyboard Left Shift key.
     */
    case LShift = 128;
    /**
     * Keyboard Left Alt key.
     */
    case LAlt = 129;
    /**
     * Keyboard Left System key.
     */
    case LSystem = 130;
    /**
     * Keyboard Right Control key.
     */
    case RControl = 131;
    /**
     * Keyboard Right Shift key.
     */
    case RShift = 132;
    /**
     * Keyboard Right Alt key.
     */
    case RAlt = 133;
    /**
     * Keyboard Right System key.
     */
    case RSystem = 134;
    /**
     * Keyboard Back key.
     */
    case Back = 135;
    /**
     * Keyboard Forward key.
     */
    case Forward = 136;
    /**
     * Keyboard Refresh key.
     */
    case Refresh = 137;
    /**
     * Keyboard Stop key.
     */
    case Stop = 138;
    /**
     * Keyboard Search key.
     */
    case Search = 139;
    /**
     * Keyboard Favorites key.
     */
    case Favorites = 140;
    /**
     * Keyboard Home Page key.
     */
    case HomePage = 141;
    /**
     * Keyboard Launch Application 1 key.
     */
    case LaunchApplication1 = 142;
    /**
     * Keyboard Launch Application 2 key.
     */
    case LaunchApplication2 = 143;
    /**
     * Keyboard Launch Mail key.
     */
    case LaunchMail = 144;
    /**
     * Keyboard Launch Media Select key.
     */
    case LaunchMediaSelect = 145;
    #[\Spem]
    public function localize(): Key {
    }
    #[\Spem("scancode_getDescription")]
    public function getDescription(): string {}
}