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

    public function seek(int $position): ?int
    {
        $this->pos = $position;
        return $position;
    }

    public function tell(): int
    {
        return $this->pos;
    }

    public int|null $size {
        get {
            return strlen($this->string);
        }
    }
}