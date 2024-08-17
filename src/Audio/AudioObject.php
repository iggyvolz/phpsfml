<?php

namespace iggyvolz\SFML\Audio;

use FFI\CData;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\Lib;
use iggyvolz\SFML\Utils\SfmlObject;

abstract class AudioObject extends SfmlObject
{
    public function asAudio(): CData
    {
        return $this->cdata;
    }

    protected static function getLib(Sfml $sfml): Lib
    {
        return $sfml->audio;
    }
}