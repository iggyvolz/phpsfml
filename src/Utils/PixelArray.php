<?php

namespace iggyvolz\SFML\Utils;

use FFI;
use FFI\CData;
use InvalidArgumentException;

readonly class PixelArray
{
    public function __construct(
        /** @internal */
        public CData $cdata,
        public int   $width,
        public int   $height,
    )
    {
    }
    public function create(array $pixels): self
    {
        if(!array_is_list($pixels)) {
            throw new InvalidArgumentException("Pixels must be a list");
        }
        if(empty($pixels)) {
            throw new InvalidArgumentException("Non-empty array required");
        }
        $height = count($pixels);
        $width = count($pixels[0]);
        // verify that each row is the same number of pixels wide
        foreach ($pixels as $row) {
            if(count($row) !== $width) {
                throw new InvalidArgumentException("All rows must be the same number of pixels wide");
            }
        }
        // flatten pixels array
        $pixelsCdata = FFI::new("unsigned char[" . ($height*$width) . "]");
        for($i = 0; $i < $height; $i++) {
            for($j = 0; $j<$width; $j++) {
                $pixelsCdata[($i*$width)+$j] = $pixels[$i][$j];
            }
        }
        return new self($pixelsCdata, $width, $height);
    }
}