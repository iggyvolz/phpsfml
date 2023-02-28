<?php

namespace iggyvolz\SFML\System;

use FFI\CData;

/**
 * Represents a time value
 * @see System/Time.h
 */
class Time
{
    public function __construct(
        private readonly SystemLib $systemLib,
        // sfTime
        /**
         * @internal
         */
        public readonly CData $cdata
    )
    {
    }

    /**
     * Predefined "zero" time value
     */
    public static function zero(SystemLib $systemLib): self
    {
        return new self($systemLib, $systemLib->ffi->sfTime_Zero);
    }

    /**
     * Return a time value as a number of seconds
     * @return float Time in seconds
     */
    public function asSeconds(): float
    {
        return $this->systemLib->ffi->sfTime_asSeconds($this->cdata);
    }

    /**
     * Return a time value as a number of milliseconds
     * @return int Time in milliseconds
     */
    public function asMilliseconds(): int
    {
        return $this->systemLib->ffi->sfTime_asMilliseconds($this->cdata);
    }

    /**
     * Return a time value as a number of microseconds
     * @return int Time in microseconds
     */
    public function asMicroseconds(): int
    {
        return $this->systemLib->ffi->sfTime_asMicroseconds($this->cdata);
    }

    /**
     * Construct a time value from a number of seconds
     * @param SystemLib $systemLib System library to load
     * @param float $amount Number of seconds
     * @return self Time value constructed from the amount of seconds
     */
    public static function fromSeconds(SystemLib $systemLib, float $amount): self
    {
        return new self($systemLib, $systemLib->ffi->sfSeconds($amount));
    }

    /**
     * Construct a time value from a number of milliseconds
     * @param SystemLib $systemLib System library to load
     * @param int $amount Number of milliseconds
     * @return self Time value constructed from the amount of milliseconds
     */
    public static function fromMilliseconds(SystemLib $systemLib, int $amount): self
    {
        return new self($systemLib, $systemLib->ffi->sfMilliseconds($amount));
    }

    /**
     * Construct a time value from a number of microseconds
     * @param SystemLib $systemLib System library to load
     * @param int $amount Number of microseconds
     * @return self Time value constructed from the amount of microseconds
     */
    public static function fromMicroseconds(SystemLib $systemLib, int $amount): self
    {
        return new self($systemLib, $systemLib->ffi->sfMicroseconds($amount));
    }

}