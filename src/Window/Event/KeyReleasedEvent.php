<?php

namespace iggyvolz\SFML\Window\Event;

use iggyvolz\SFML\Window\Key;
use iggyvolz\SFML\Window\Scancode;
use Spem;

final class KeyReleasedEvent extends Event
{
    public Key $code{#[Spem("keyreleased_getcode")]get{}}
    public Scancode $scancode{#[Spem("keyreleased_getscancode")]get{}}
    public bool $alt{#[Spem("keyreleased_getalt")]get{}}
    public bool $control{#[Spem("keyreleased_getcontrol")]get{}}
    public bool $shift{#[Spem("keyreleased_getshift")]get{}}
    public bool $system{#[Spem("keyreleased_getsystem")]get{}}
    public function __debugInfo(): ?array
    {
        return ["code" => $this->code, "scancode" => $this->scancode, "alt" => $this->alt, "control" => $this->control, "shift" => $this->shift, "system" => $this->system];
    }
}
