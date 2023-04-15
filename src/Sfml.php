<?php

namespace iggyvolz\SFML;

use iggyvolz\SFML\Audio\AudioLib;
use iggyvolz\SFML\Graphics\GraphicsLib;
use iggyvolz\SFML\Network\NetworkLib;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\Window\WindowLib;

class Sfml
{
    public readonly AudioLib $audio;
    public readonly GraphicsLib $graphics;
    public readonly NetworkLib $network;
    public readonly SystemLib $system;
    public readonly WindowLib $window;
    public function __construct(
        string $audioLibPath,
        string $graphicsLibPath,
        string $networkLibPath,
        string $systemLibPath,
        string $windowLibPath,
    )
    {
        $this->audio = new AudioLib($this, $audioLibPath);
        $this->graphics = new GraphicsLib($this, $graphicsLibPath);
        $this->network = new NetworkLib($this, $networkLibPath);
        $this->system = new SystemLib($this, $systemLibPath);
        $this->window = new WindowLib($this, $windowLibPath);
    }
}