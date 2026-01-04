<?php

namespace iggyvolz\SFML\System;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;
use Spem;

class Time
{
    private function __construct() {}
    /**
     * Predefined "zero" time value
     */
    #[Spem("libphpsfml.so", "time_zero")]
    public static function zero(): self
    {
    }

    public float $seconds { #[Spem("libphpsfml.so", "time_asSeconds")] get {}}

    public int $milliseconds { #[Spem("libphpsfml.so", "time_asMilliseconds")] get {}}

    public int $microseconds { #[Spem("libphpsfml.so", "time_asMicroseconds")] get {}}

    /**
     * Construct a time value from a number of seconds
     * @param float $amount Number of seconds
     * @return self Time value constructed from the amount of seconds
     */
    #[Spem("libphpsfml.so", "time_fromSeconds")]
    public static function fromSeconds(float $amount): self
    {
    }

    /**
     * Construct a time value from a number of milliseconds
     * @param int $amount Number of milliseconds
     * @return self Time value constructed from the amount of milliseconds
     */
    #[Spem("libphpsfml.so", "time_fromMilliseconds")]
    public static function fromMilliseconds(int $amount): self
    {
    }

    /**
     * Construct a time value from a number of microseconds
     * @param int $amount Number of microseconds
     * @return self Time value constructed from the amount of microseconds
     */
    #[Spem("libphpsfml.so", "time_fromMicroseconds")]
    public static function fromMicroseconds(int $amount): self
    {
    }

    #[Spem("libphpsfml.so", "time_destruct")]
    public function __destruct()
    {
    }
}