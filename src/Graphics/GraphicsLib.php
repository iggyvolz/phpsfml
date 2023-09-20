<?php

namespace iggyvolz\SFML\Graphics;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\Lib;

readonly class GraphicsLib extends Lib
{
    public function __construct(Sfml $sfml, string $libPath)
    {
        parent::__construct($sfml, __DIR__ . "/Graphics.h", $libPath);
    }
}
