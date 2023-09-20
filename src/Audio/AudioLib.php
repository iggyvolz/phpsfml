<?php

namespace iggyvolz\SFML\Audio;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\Lib;

readonly class AudioLib extends Lib
{
    public Listener $listener;
    public function __construct(Sfml $sfml, string $libPath)
    {
        parent::__construct($sfml, __DIR__ . "/Audio.h", $libPath);
        $this->listener = new Listener($this);
    }
}
