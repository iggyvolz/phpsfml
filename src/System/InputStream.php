<?php

namespace iggyvolz\SFML\System;

use FFI;
use FFI\CData;

readonly class InputStream implements InputStreamInterface
{
    public function __construct(
        private SystemLib $systemLib,
        // sfInputStream
        private CData     $cdata
    )
    {
    }

    /**
     * @param SystemLib $lib Opened library
     * @param InputStreamInterface $stream Opened stream
     * @return self
     */
    public static function create(SystemLib $lib, InputStreamInterface $stream): self
    {
        $sfInputStream = $lib->ffi->new("sfInputStream");
        $sfInputStream->read = function (CData $data, int $size, ?CData $userData) use($stream): int {
            FFI::memcpy($data, $stream->read($size), $size);
            return $size;
        };
        $sfInputStream->seek = function(int $position, ?CData $userData) use($stream): int {
            $stream->seek($position);
            return $position;
        };
        $sfInputStream->tell = function(?CData $userData) use($stream): int {
            return $stream->tell();
        };
        $sfInputStream->getSize = function(?CData $userData) use($stream): int {
            return $stream->getSize();
        };
        return new self($lib, $sfInputStream);
    }

    /**
     * @param SystemLib $lib
     * @param resource $stream Opened stream
     * @return self
     */
    public static function createFromStream(SystemLib $lib, mixed $stream): self
    {
        return self::create($lib, new InputStreamFromStream($stream));
    }

    /**
     * @param SystemLib $lib
     * @param string $file Path to file
     * @return self
     */
    public static function createFromFile(SystemLib $lib, string $file): self
    {
        return self::createFromStream($lib, fopen($file, "r"));
    }

    /**
     * @param SystemLib $lib
     * @param string $string String to be read
     * @return self
     */
    public static function createFromString(SystemLib $lib, string $string): self
    {
        return self::create($lib, new InputStreamFromString($string));
    }

    public function read(int $size): string
    {
        $string = $this->systemLib->ffi->new("char[$size]");
        ($this->cdata->read)($this->systemLib->ffi->cast("void*", FFI::addr($string)), $size, $this->cdata->userData);
        return FFI::string($string, $size);
    }

    public function seek(int $position): void
    {
        ($this->cdata->seek)($position, $this->cdata->userData);
    }

    public function tell(): int
    {
        return ($this->cdata->tell)($this->cdata->userData);
    }

    public function getSize(): int
    {
        return ($this->cdata->getSize)($this->cdata->userData);
    }
}