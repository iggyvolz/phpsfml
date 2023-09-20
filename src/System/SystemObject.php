<?php

namespace iggyvolz\SFML\System;

use Dont\DontDeserialise;
use Dont\DontSerialise;
use FFI\CData;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\DontCloneNonFinal;
use iggyvolz\SFML\Utils\Lib;
use iggyvolz\SFML\Utils\SfmlObject;

abstract class SystemObject extends SfmlObject
{
    use DontCloneNonFinal;
    use DontSerialise;
    use DontDeserialise;
    public function asSystem(): CData
    {
        return $this->cdata;
    }

    protected static function getLib(Sfml $sfml): Lib
    {
        return $sfml->system;
    }
}