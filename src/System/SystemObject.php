<?php

namespace iggyvolz\SFML\System;

use FFI\CData;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\Lib;
use iggyvolz\SFML\Utils\SfmlObject;

/** @deprecated  */
abstract class SystemObject extends SfmlObject
{
    public function asSystem(): CData
    {
        return $this->cdata;
    }

    protected static function getLib(Sfml $sfml): Lib
    {
        return $sfml->system;
    }
}