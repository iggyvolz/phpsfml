<?php

namespace iggyvolz\SFML\System;

use FFI\CData;

class Clock
{
    public function __construct(
        private readonly SystemLib $systemLib,
        // sfClock*
        private /* [almost] readonly */ CData $cdata
    )
    {
    }

    /**
     * Create a new clock and start it
     * @param SystemLib $systemLib System library to load
     * @return self A new sfClock object
     */
    public static function create(SystemLib $systemLib): self
    {
        return new self($systemLib, $systemLib->ffi->sfClock_create());
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
        return new Time($this->systemLib, $this->systemLib->ffi->sfClock_getElapsedTime($this->cdata));
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
        return new Time($this->systemLib, $this->systemLib->ffi->sfClock_restart($this->cdata));
    }

    public function __clone(): void
    {
        $this->cdata = $this->systemLib->ffi->sfClock_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->systemLib->ffi->sfClock_destroy($this->cdata);
    }

}