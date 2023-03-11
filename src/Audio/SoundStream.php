<?php

namespace iggyvolz\SFML\Audio;

use iggyvolz\SFML\System\Time;

interface SoundStream extends SoundSource
{
    public function getChannelCount(): int;
    public function getSampleRate(): int;
    public function getPlayingOffset(): Time;
    public function setPlayingOffset(Time $timeOffset): void;
    public function setLoop(bool $loop);
    public function getLoop(): bool;
}