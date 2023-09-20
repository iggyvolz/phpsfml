<?php

namespace iggyvolz\SFML\System;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

#[CType("sfClock*")]
class Clock extends SystemObject
{
    /**
     * Create a new clock and start it
     * @return self A new sfClock object
     */
    public static function create(Sfml $sfml): self
    {
        return new self($sfml, $sfml->system->ffi->sfClock_create());
    }

    /**
     * Get the time elapsed in a clock
     *
     * This function returns the time elapsed since the last call
     * to sfClock_restart (or the construction of the object if
     * sfClock_restart has not been called).
     * @return Time Time elapsed
     */
    public function getElapsedTime(): Time
    {
        return new Time($this->sfml, $this->sfml->system->ffi->sfClock_getElapsedTime($this->cdata));
    }

    /**
     * Restart a clock
     *
     * This function puts the time counter back to zero.
     * It also returns the time elapsed since the clock was started.
     * @return Time Time elapsed
     */
    public function restart(): Time
    {
        return new Time($this->sfml, $this->sfml->system->ffi->sfClock_restart($this->cdata));
    }

    public function __clone(): void
    {
        $this->cdata = $this->sfml->system->ffi->sfClock_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->sfml->system->ffi->sfClock_destroy($this->cdata);
    }

}