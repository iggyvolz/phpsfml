<?php

namespace iggyvolz\SFML\System;

use FFI;
use FFI\CData;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

#[CType("sfInputStream")]
class InputStream extends SystemObject implements InputStreamInterface
{
    /**
     * @param InputStreamInterface $stream Opened stream
     * @return self
     */
    public static function create(Sfml $sfml, InputStreamInterface $stream): self
    {
        $sfInputStream = $sfml->system->ffi->new("sfInputStream");
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
        return new self($sfml, $sfInputStream);
    }

    /**
     * @param resource $stream Opened stream
     * @return self
     */
    public static function createFromStream(Sfml $sfml, mixed $stream): self
    {
        return self::create($sfml, new InputStreamFromStream($stream));
    }

    /**
     * @param string $file Path to file
     * @return self
     */
    public static function createFromFile(Sfml $sfml, string $file): self
    {
        return self::createFromStream($sfml, fopen($file, "r"));
    }

    /**
     * @param string $string String to be read
     * @return self
     */
    public static function createFromString(Sfml $sfml, string $string): self
    {
        return self::create($sfml, new InputStreamFromString($string));
    }

    public function read(int $size): string
    {
        $string = $this->sfml->system->ffi->new("char[$size]");
        ($this->cdata->read)($this->sfml->system->ffi->cast("void*", FFI::addr($string)), $size, $this->cdata->userData);
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