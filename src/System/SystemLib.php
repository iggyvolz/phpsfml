<?php

namespace iggyvolz\SFML\System;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\Lib;

readonly class SystemLib extends Lib
{
    public function __construct(Sfml $sfml, string $libPath)
    {
        parent::__construct($sfml, __DIR__ . "/System.h", $libPath);
    }

    /**
     * Make the current thread sleep for a given duration
     *
     * sfSleep is the best way to block a program or one of its
     * threads, as it doesn't consume any CPU power.
     * @param Time $duration Time to sleep
     * @return void
     */
    public function sleep(Time $duration): void
    {
        $this->ffi->sfSleep($duration->asSystem());
    }
}
