<?php

namespace iggyvolz\SFML\Utils;

use FFI;
use FFI\CData;

readonly class UTF32
{
    public function __construct(
        // const uint32_t*
        public CData $cdata
    )
    {
    }
    public function toString(string $encoding = "UTF-8"): string
    {
        $length = 0;
        while($this->cdata[$length] !== 0) {
            $length++;
        }

        return mb_convert_encoding(FFI::string(FFI::cast("const char*", $this->cdata), ($length) * 4), $encoding, "UTF-32LE");
    }
    public static function fromString(string $string, string $encoding = "UTF-8"): self
    {
        $string = mb_convert_encoding($string, "UTF-32LE", $encoding);
        $string .= "\0\0\0\0"; // Null terminator
        $str = FFI::new("const uint32_t[" . (strlen($string) / 4) . "]");
        FFI::memcpy($str, $string, strlen($string));
        return new self(FFI::cast("const uint32_t*", $str));
    }
    public function __toString(): string
    {
        return $this->toString();
    }
}