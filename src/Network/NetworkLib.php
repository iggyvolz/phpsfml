<?php

namespace iggyvolz\SFML\Network;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\Lib;

readonly class NetworkLib extends Lib
{
    public function __construct(Sfml $sfml, string $libPath)
    {
        parent::__construct($sfml, __DIR__ . "/Network.h", $libPath);
    }
}
