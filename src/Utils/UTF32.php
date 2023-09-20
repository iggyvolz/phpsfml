<?php

namespace iggyvolz\SFML\Utils;

use FFI;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\SystemObject;

#[CType("uint32_t*")]
class UTF32 extends SystemObject
{
    public function toString(string $encoding = "UTF-8"): string
    {
        $length = 0;
        while ($this->cdata[$length] !== 0) {
            $length++;
        }

        return mb_convert_encoding(FFI::string(FFI::cast("const char*", $this->cdata), ($length) * 4), $encoding, "UTF-32LE");
    }

    public static function fromString(Sfml $sfml, string $string, string $encoding = "UTF-8"): self
    {
        $string = mb_convert_encoding("$string\0", "UTF-32LE", $encoding);
        $str = $sfml->system->ffi->new("uint32_t[" . (strlen($string) / 4) . "]");
        FFI::memcpy($str, $string, strlen($string));
        return new self($sfml, FFI::cast("const uint32_t*", $str));
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}