<?php

namespace iggyvolz\SFML\System;

class InputStreamFromString implements InputStreamInterface
{
    private int $pos = 0;
    public function __construct(private readonly string $string)
    {
    }

    public function read(int $size): string
    {
        $str = substr($this->string, $this->pos,  $size);
        $this->pos += $size;
        return $str;
    }

    public function seek(int $position): void
    {
        $this->pos = $position;
    }

    public function tell(): int
    {
        return $this->pos;
    }

    public function getSize(): int
    {
        return strlen($this->string);
    }
}