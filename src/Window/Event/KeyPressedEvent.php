<?php

namespace iggyvolz\SFML\Window\Event;

use iggyvolz\SFML\Window\Key;
use iggyvolz\SFML\Window\Scancode;
use Spem;

final class KeyPressedEvent extends Event
{
    public Key $code{#[Spem("libphpsfml.so", "keypressed_getcode")]get{}}
    public Scancode $scancode{#[Spem("libphpsfml.so", "keypressed_getscancode")]get{}}
    public bool $alt{#[Spem("libphpsfml.so", "keypressed_getalt")]get{}}
    public bool $control{#[Spem("libphpsfml.so", "keypressed_getcontrol")]get{}}
    public bool $shift{#[Spem("libphpsfml.so", "keypressed_getshift")]get{}}
    public bool $system{#[Spem("libphpsfml.so", "keypressed_getsystem")]get{}}
    public function __debugInfo(): ?array
    {
        return ["code" => $this->code, "scancode" => $this->scancode, "alt" => $this->alt, "control" => $this->control, "shift" => $this->shift, "system" => $this->system];
    }
}