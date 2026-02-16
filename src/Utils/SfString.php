<?php

namespace iggyvolz\SFML\Utils;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

final class SfString
{
    #[\Spem("libphpsfml.so", "sfstring_construct")]
    public function __construct(string $string)
    {
    }
    public string $data { #[\Spem("libphpsfml.so", "sfstring_tostring")] get {}}

    public function __toString(): string
    {
        return $this->data;
    }

    public function toString(string $encoding = "UTF-8"): string
    {
        return mb_convert_encoding($this->data, $encoding, "UTF-8");
    }

    #[\Spem("libphpsfml.so", "sfstring_append")]
    public function append(SfString $string): void
    {

    }

    #[\Spem("libphpsfml.so", "sfstring_clear")]
    public function clear(): void
    {

    }

    public int $size { #[\Spem("libphpsfml.so", "sfstring_size")] get {}}

    public bool $isEmpty { #[\Spem("libphpsfml.so", "sfstring_isEmpty")] get{}}

    #[\Spem("libphpsfml.so", "sfstring_erase")]
    public function erase(int $position, int $count = 1): void
    {

    }

    #[\Spem("libphpsfml.so", "sfstring_insert")]
    public function insert(int $position, SfString $str): void
    {

    }

    #[\Spem("libphpsfml.so", "sfstring_find")]
    public function find(SfString $str, int $start = 0): ?int
    {

    }

    #[\Spem("libphpsfml.so", "sfstring_replaceLength")]
    public function replaceLength(int $position, int $length, SfString $replaceWith): void
    {

    }

    #[\Spem("libphpsfml.so", "sfstring_replaceString")]
    public function replaceString(SfString $searchFor, SfString $replaceWith): void
    {

    }

    #[\Spem("libphpsfml.so", "sfstring_substring")]
    public function substring(int $position, ?int $length = null): SfString
    {

    }

    #[\Spem("libphpsfml.so", "sfstring_destruct")]
    public function __destruct()
    {
    }
}