<?php

namespace iggyvolz\SFML\Window;
use FFI;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Time;

readonly class WindowLib
{
    public FFI $ffi;
    public function __construct(string $libPath, public SystemLib $systemLib)
    {
        $this->ffi = FFI::cdef(file_get_contents(__DIR__ . "/Window.h"), $libPath);
    }
}
