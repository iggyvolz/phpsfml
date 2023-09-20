<?php

namespace iggyvolz\SFML\Utils;

use FFI;
use iggyvolz\SFML\Sfml;

readonly abstract class Lib
{
    /** @internal */
    public FFIProxy $ffi;
    public function __construct(public Sfml $sfml, string $headerPath, string $libPath)
    {
        $this->ffi = new FFIProxy(FFI::cdef(file_get_contents($headerPath), $libPath));
    }
}