<?php

namespace iggyvolz\SFML\Audio;

use iggyvolz\SFML\System\Vector\Vector3F;

interface SoundSource
{
    public function setPitch(float $pitch): void;
    public function setVolume(float $volume): void;
    public function setPosition(Vector3F $position): void;
    public function setRelativeToListener(bool $relative): void;
    public function setMinDistance(float $distance): void;
    public function setAttenuation(float $attenuation): void;
    public function getPitch(): float;
    public function getVolume(): float;
    public function getPosition(): Vector3F;
    public function isRelativeToListener(): bool;
    public function getMinDistance(): float;
    public function getAttenuation(): float;
    public function play(): void;
    public function pause(): void;
    public function stop(): void;
    public function getStatus(): SoundStatus;
}