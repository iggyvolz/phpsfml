<?php

namespace iggyvolz\SFML\System;

interface InputStreamInterface
{
    /**
     * Function to read data from the stream
     * @param int $size Number of bytes to read
     * @return ?string Bytes read from stream
     */
    public function read(int $size): ?string;

    /**
     * Function to set the current read position
     * @param int $position Position to set to
     * @return ?int
     */
    public function seek(int $position): ?int;

    /**
     * Function to get the current read position
     * @return ?int Current read position
     */
    public function tell(): ?int;

    /**
     * Function to get the total number of bytes in the stream
     * @return int Total number of bytes in the stream
     */
    public ?int $size { get; }

}