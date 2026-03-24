<?php

namespace iggyvolz\SFML\System;

class InputStream implements InputStreamInterface
{

    /**
     * @param InputStreamInterface $stream Opened stream
     */
    #[\Spem("inputstream_construct")]
    public function __construct(InputStreamInterface $stream)
    {
    }

    /**
     * @param resource $stream Opened stream
     * @return self
     */
    public static function createFromStream(mixed $stream): self
    {
        return new self(new InputStreamFromStream($stream));
    }

    /**
     * @param string $file Path to file
     * @return self
     */
    public static function createFromFile(string $file): self
    {
        return self::createFromStream(fopen($file, "r"));
    }

    /**
     * @param string $string String to be read
     * @return self
     */
    public static function createFromString(string $string): self
    {
        return new self(new InputStreamFromString($string));
    }

    #[\Spem("inputstream_read")]
    public function read(int $size): string
    {
    }

    #[\Spem("inputstream_seek")]
    public function seek(int $position): ?int
    {
    }

    #[\Spem("inputstream_tell")]
    public function tell(): ?int
    {
    }
    public ?int $size { #[\Spem("inputstream_size")] get {}}

    #[\Spem("inputstream_destruct")]
    public function __destruct()
    {
    }
}