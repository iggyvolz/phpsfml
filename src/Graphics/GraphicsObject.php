<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\Lib;
use iggyvolz\SFML\Utils\SfmlObject;

abstract class GraphicsObject extends SfmlObject
{
    public function asGraphics(): CData
    {
        return $this->cdata;
    }

    protected static function getLib(Sfml $sfml): Lib
    {
        return $sfml->graphics;
    }
}