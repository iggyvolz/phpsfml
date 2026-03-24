<?php

namespace iggyvolz\SFML\Window\Event;

use iggyvolz\SFML\Window\Key;
use iggyvolz\SFML\Window\Scancode;
use Spem;

final class KeyPressedEvent extends Event
{
    public Key $code{#[Spem("keypressed_getcode")]get{}}
    public Scancode $scancode{#[Spem("keypressed_getscancode")]get{}}
    public bool $alt{#[Spem("keypressed_getalt")]get{}}
    public bool $control{#[Spem("keypressed_getcontrol")]get{}}
    public bool $shift{#[Spem("keypressed_getshift")]get{}}
    public bool $system{#[Spem("keypressed_getsystem")]get{}}
    public function __debugInfo(): ?array
    {
        return ["code" => $this->code, "scancode" => $this->scancode, "alt" => $this->alt, "control" => $this->control, "shift" => $this->shift, "system" => $this->system];
    }
}