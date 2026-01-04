<?php

namespace iggyvolz\SFML\System;

class InputStream implements InputStreamInterface
{
    private function __construct()
    {
    }

    /**
     * @param InputStreamInterface $stream Opened stream
     * @return self
     */
    #[\Spem("libphpsfml.so", "inputstream_create")]
    public static function create(InputStreamInterface $stream): self
    {
    }

    /**
     * @param resource $stream Opened stream
     * @return self
     */
    public static function createFromStream(mixed $stream): self
    {
        return self::create(new InputStreamFromStream($stream));
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
        return self::create(new InputStreamFromString($string));
    }

    #[\Spem("libphpsfml.so", "inputstream_read")]
    public function read(int $size): string
    {
    }

    #[\Spem("libphpsfml.so", "inputstream_seek")]
    public function seek(int $position): ?int
    {
    }

    #[\Spem("libphpsfml.so", "inputstream_tell")]
    public function tell(): ?int
    {
    }
    public ?int $size { #[\Spem("libphpsfml.so", "inputstream_size")] get {}}


    #[\Deprecated]
    public function getSize(): int
    {
        return $this->size;
    }

    #[\Spem("libphpsfml.so", "inputstream_destruct")]
    public function __destruct()
    {
    }
}