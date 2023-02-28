<?php

namespace iggyvolz\SFML\System;

use Closure;
use FFI\CData;

/**
 * TODO this instantly segfaults.  Hahahahahahaa *cries*
 */
readonly class Thread
{
    public function __construct(
        private SystemLib $systemLib,
        // sfThread*
        private CData     $cdata
    )
    {
    }

    /**
     * Create a new thread from a function
     *
     * Note: this does *not* run the thread, use launch.
     * @param SystemLib $systemLib System library to load
     * @param Closure $function Entry point of the thread
     * @return self A new sfThread object
     */
    public static function create(SystemLib $systemLib, Closure $function): self
    {
        // TODO passing function pointers into functions is dubious
        // exceptions are gonna happen ahhhh
        return new self($systemLib, $systemLib->ffi->sfThread_create(function(CData $_) use($function){
            $function();
        }, null));
    }

    /**
     * Destroy a thread
     *
     * This function calls sfThread_wait, so that the internal thread
     * cannot survive after the sfThread object is destroyed.
     */
    public function __destruct()
    {
        $this->systemLib->ffi->sfThread_destroy($this->cdata);
    }

    /**
     * Run a thread
     *
     * This function starts the entry point passed to the
     * thread's constructor, and returns immediately.
     * After this function returns, the thread's function is
     * running in parallel to the calling code.
     * @return void
     */
    public function launch(): void
    {
        $this->systemLib->ffi->sfThread_launch($this->cdata);
    }

    /**
     * Wait until a thread finishes
     *
     * This function will block the execution until the
     * thread's function ends.
     * Warning: if the thread function never ends, the calling
     * thread will block forever.
     * If this function is called from its owner thread, it
     * returns without doing anything.
     * @return void
     */
    public function wait(): void
    {
        $this->systemLib->ffi->sfThread_wait($this->cdata);
    }
}