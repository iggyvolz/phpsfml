<?php

namespace iggyvolz\SFML\System;

use FFI\CData;

class Mutex
{
    public function __construct(
        private readonly SystemLib $systemLib,
        // sfMutex*
        private readonly CData $cdata
    )
    {
    }


    /**
     * Create a new mutex
     * @param SystemLib $systemLib System library to load
     * @return self A new sfMutex object
     */
    public static function create(SystemLib $systemLib): self
    {
        return new self($systemLib, $systemLib->ffi->sfMutex_create());
    }

    /**
     * Lock a mutex
     * @return void
     */
    public function lock(): void
    {
        $this->systemLib->ffi->sfMutex_lock($this->cdata);
    }

    /**
     * Unlock a mutex
     * @return void
     */
    public function unlock(): void
    {
        $this->systemLib->ffi->sfMutex_unlock($this->cdata);
    }

    /**
     * Destroy a mutex
     */
    public function __destruct()
    {
        $this->systemLib->ffi->sfMutex_destroy($this->cdata);
    }


}