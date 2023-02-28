<?php

namespace iggyvolz\SFML\Audio;
use FFI;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\Window\WindowLib;

readonly class AudioLib
{
    public FFI $ffi;
    public function __construct(string $libPath)
    {
        $this->ffi = FFI::cdef(file_get_contents(__DIR__ . "/Audio.h"), $libPath);
    }
}
