<?php

namespace iggyvolz\SFML\Window\Event\EventData;

use iggyvolz\SFML\Window\Event\Event;
use iggyvolz\SFML\Window\KeyCode;

abstract class KeyDataEvent extends Event
{
    public function getKeyCode(): KeyCode
    {
        return KeyCode::from($this->cdata->keyCode);
    }
    public function setKeyCode(KeyCode $keyCode): void
    {
        $this->cdata->keyCode = $keyCode->value;
    }
    public function getAlt(): bool
    {
        return $this->cdata->alt === 1;
    }
    public function setAlt(bool $alt): void
    {
        $this->cdata->alt = $alt ? 1 : 0;
    }
    public function getControl(): bool
    {
        return $this->cdata->control === 1;
    }
    public function setControl(bool $control): void
    {
        $this->cdata->control = $control ? 1 : 0;
    }
    public function getShift(): bool
    {
        return $this->cdata->shift === 1;
    }
    public function setShift(bool $shift): void
    {
        $this->cdata->shift = $shift ? 1 : 0;
    }
    public function getSystem(): bool
    {
        return $this->cdata->system === 1;
    }
    public function setSystem(bool $system): void
    {
        $this->cdata->system = $system ? 1 : 0;
    }
}