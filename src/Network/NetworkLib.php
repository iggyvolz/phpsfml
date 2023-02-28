<?php

namespace iggyvolz\SFML\Network;
use FFI;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\Window\WindowLib;

readonly class NetworkLib
{
    public FFI $ffi;
    public function __construct(string $libPath)
    {
        $this->ffi = FFI::cdef(file_get_contents(__DIR__ . "/Network.h"), $libPath);
    }
}
