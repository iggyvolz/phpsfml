<?php

namespace iggyvolz\SFML\System;

readonly class InputStreamFromStream implements InputStreamInterface
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

    public function seek(int $position): void
    {
        fseek($this->stream, $position);
    }

    public function tell(): int
    {
        return ftell($this->stream);
    }

    public function getSize(): int
    {
        return fstat($this->stream)["size"];
    }
}