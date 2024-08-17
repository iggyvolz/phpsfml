<?php

namespace iggyvolz\SFML\Window;

use FFI\CData;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\Lib;
use iggyvolz\SFML\Utils\SfmlObject;

abstract class WindowObject extends SfmlObject
{
    public function asWindow(): CData
    {
        return $this->cdata;
    }

    protected static function getLib(Sfml $sfml): Lib
    {
        return $sfml->window;
    }
}