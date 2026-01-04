<?php

namespace iggyvolz\SFML\System;

class InputStreamFromStream implements InputStreamInterface
{

    /**
     * @param resource $stream
     */
    public function __construct(public mixed $stream)
    {
    }

    public function read(int $size): string
    {
        return fread($this->stream, $size);
    }

    public function seek(int $position): ?int
    {
        fseek($this->stream, $position);
        return $position;
    }

    public function tell(): int
    {
        return ftell($this->stream);
    }

    public int|null $size {
        get {
            return fstat($this->stream)["size"];
        }
    }
}