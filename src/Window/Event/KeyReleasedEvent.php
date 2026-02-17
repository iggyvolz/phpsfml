<?php

namespace iggyvolz\SFML\Window\Event;

use iggyvolz\SFML\Window\Key;
use iggyvolz\SFML\Window\Scancode;
use Spem;

final class KeyReleasedEvent extends Event
{
    public Key $code{#[Spem("libphpsfml.so", "keyreleased_getcode")]get{}}
    public Scancode $scancode{#[Spem("libphpsfml.so", "keyreleased_getscancode")]get{}}
    public bool $alt{#[Spem("libphpsfml.so", "keyreleased_getalt")]get{}}
    public bool $control{#[Spem("libphpsfml.so", "keyreleased_getcontrol")]get{}}
    public bool $shift{#[Spem("libphpsfml.so", "keyreleased_getshift")]get{}}
    public bool $system{#[Spem("libphpsfml.so", "keyreleased_getsystem")]get{}}
    public function __debugInfo(): ?array
    {
        return ["code" => $this->code, "scancode" => $this->scancode, "alt" => $this->alt, "control" => $this->control, "shift" => $this->shift, "system" => $this->system];
    }
}
