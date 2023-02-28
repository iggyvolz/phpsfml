<?php

namespace iggyvolz\SFML\System;
use FFI;

readonly class SystemLib
{
    public FFI $ffi;
    public function __construct(string $libPath)
    {
        $this->ffi = FFI::cdef(file_get_contents(__DIR__ . "/System.h"), $libPath);
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
        $this->ffi->sfSleep($duration->cdata);
    }
}
