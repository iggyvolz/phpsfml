<?php

namespace iggyvolz\SFML\Audio;

use Dont\DontDeserialise;
use Dont\DontSerialise;
use FFI\CData;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\DontCloneNonFinal;
use iggyvolz\SFML\Utils\Lib;
use iggyvolz\SFML\Utils\SfmlObject;

abstract class AudioObject extends SfmlObject
{
    use DontCloneNonFinal;
    use DontSerialise;
    use DontDeserialise;
    public function asAudio(): CData
    {
        return $this->cdata;
    }

    protected static function getLib(Sfml $sfml): Lib
    {
        return $sfml->audio;
    }
}