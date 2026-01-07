<?php

namespace iggyvolz\SFML\System;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

class Clock
{
    /**
     * Create a new clock and start it
     */
    #[\Spem("libphpsfml.so", "clock_construct")]
    public function __construct(){}

    /**
     * Get the time elapsed in a clock
     *
     * This function returns the time elapsed since the last call
     * to sfClock_restart (or the construction of the object if
     * sfClock_restart has not been called).
     * @return Time Time elapsed
     */
    public Time $elapsedTime { #[\Spem("libphpsfml.so", "clock_elapsedTime")] get {}}

    /**
     * Restart a clock
     *
     * This function puts the time counter back to zero.
     * It also returns the time elapsed since the clock was started.
     * @return Time Time elapsed
     */
    #[\Spem("libphpsfml.so", "clock_restart")]
    public function restart(): Time
    {
    }
    #[\Spem("libphpsfml.so", "clock_destruct")]
    public function __destruct()
    {
    }

}