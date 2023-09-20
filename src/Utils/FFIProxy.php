<?php

namespace iggyvolz\SFML\Utils;

use FFI;
use FFI\CData;

/**
 * A class to make phpstorm stop complaining that methods aren't defined on FFI
 */
final readonly class FFIProxy
{
    public function __construct(private FFI $ffi)
    {
    }

    public function __call(string $name, array $arguments): mixed
    {
        return $this->ffi->$name(...$arguments);
    }

    public function __get(string $name): mixed
    {
        return $this->ffi->$name;
    }

    public function __set(string $name, mixed $value): void
    {
        $this->ffi->$name = $value;
    }

    public function cast(string $type, CData $ptr): CData
    {
        return $this->ffi->cast($type, $ptr);
    }

    public function new(string $type): CData
    {
        return $this->ffi->new($type);
    }
}