<?php

namespace iggyvolz\SFML\System;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

/**
 * Represents a time value
 * @see System/Time.h
 */
#[CType("sfTime")]
class Time extends SystemObject
{

    /**
     * Predefined "zero" time value
     */
    public static function zero(Sfml $sfml): self
    {
        return new self($sfml, $sfml->system->ffi->sfTime_Zero);
    }

    /**
     * Return a time value as a number of seconds
     * @return float Time in seconds
     */
    public function asSeconds(): float
    {
        return $this->sfml->system->ffi->sfTime_asSeconds($this->cdata);
    }

    /**
     * Return a time value as a number of milliseconds
     * @return int Time in milliseconds
     */
    public function asMilliseconds(): int
    {
        return $this->sfml->system->ffi->sfTime_asMilliseconds($this->cdata);
    }

    /**
     * Return a time value as a number of microseconds
     * @return int Time in microseconds
     */
    public function asMicroseconds(): int
    {
        return $this->sfml->system->ffi->sfTime_asMicroseconds($this->cdata);
    }

    /**
     * Construct a time value from a number of seconds
     * @param float $amount Number of seconds
     * @return self Time value constructed from the amount of seconds
     */
    public static function fromSeconds(Sfml $sfml, float $amount): self
    {
        return new self($sfml, $sfml->system->ffi->sfSeconds($amount));
    }

    /**
     * Construct a time value from a number of milliseconds
     * @param int $amount Number of milliseconds
     * @return self Time value constructed from the amount of milliseconds
     */
    public static function fromMilliseconds(Sfml $sfml, int $amount): self
    {
        return new self($sfml, $sfml->system->ffi->sfMilliseconds($amount));
    }

    /**
     * Construct a time value from a number of microseconds
     * @param int $amount Number of microseconds
     * @return self Time value constructed from the amount of microseconds
     */
    public static function fromMicroseconds(Sfml $sfml, int $amount): self
    {
        return new self($sfml, $sfml->system->ffi->sfMicroseconds($amount));
    }

}