<?php

namespace iggyvolz\SFML\Audio;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\System\Vector\Vector3F;
use iggyvolz\SFML\Utils\CType;

#[CType("sfSound")]
class Sound extends AudioObject implements SoundSource
{
    public static function create(
        Sfml $sfml,
    ): self
    {
        return new self($sfml, $sfml->audio->ffi->sfSound_create());
    }
    public function __clone(): void
    {
        $this->cdata = $this->sfml->audio->ffi->sfSound_copy($this->cdata);
    }
    public function __destruct()
    {
        $this->sfml->audio->ffi->sfSound_destroy($this->cdata);
    }

    public function setPitch(float $pitch): void
    {
        $this->sfml->audio->ffi->sfSound_setPitch($this->cdata, $pitch);
    }

    public function setVolume(float $volume): void
    {
        $this->sfml->audio->ffi->sfSound_setVolume($this->cdata, $volume);
    }

    public function setPosition(Vector3F $position): void
    {
        $this->sfml->audio->ffi->sfSound_setPosition($this->cdata, $position->asAudio());
    }

    public function setRelativeToListener(bool $relative): void
    {
        $this->sfml->audio->ffi->sfSound_setRelativeToListener($this->cdata, $relative ? 1 : 0);
    }

    public function setMinDistance(float $distance): void
    {
        $this->sfml->audio->ffi->sfSound_setMinDistance($this->cdata, $distance);
    }

    public function setAttenuation(float $attenuation): void
    {
        $this->sfml->audio->ffi->sfSound_setAttenuation($this->cdata, $attenuation);
    }

    public function setPlayingOffset(Time $timeOffset): void
    {
        $this->sfml->audio->ffi->sfSound_setPlayingOffset($this->cdata, $timeOffset->asAudio());
    }

    public function getPlayingOffset(): Time
    {
        return new Time($this->sfml, $this->sfml->audio->ffi->sfSound_getPlayingOffset($this->cdata));
    }

    public function getPitch(): float
    {
        return $this->sfml->audio->ffi->sfSound_getPitch($this->cdata);
    }

    public function getVolume(): float
    {
        return $this->sfml->audio->ffi->sfSound_getVolume($this->cdata);
    }

    public function getPosition(): Vector3F
    {
        return new Vector3F($this->sfml, $this->sfml->audio->ffi->sfSound_getPosition($this->cdata), true);
    }

    public function isRelativeToListener(): bool
    {
        return $this->sfml->audio->ffi->sfSound_isRelativeToListener($this->cdata) ? 1 : 0;
    }

    public function getMinDistance(): float
    {
        return $this->sfml->audio->ffi->sfSound_getMinDistance($this->cdata);
    }

    public function getAttenuation(): float
    {
        return $this->sfml->audio->ffi->sfSound_getAttenuation($this->cdata);
    }

    public function play(): void
    {
        $this->sfml->audio->ffi->sfSound_play($this->cdata);
    }

    public function pause(): void
    {
        $this->sfml->audio->ffi->sfSound_pause($this->cdata);
    }

    public function stop(): void
    {
        $this->sfml->audio->ffi->sfSound_stop($this->cdata);
    }

    public function getStatus(): SoundStatus
    {
        return SoundStatus::from($this->sfml->audio->ffi->sfSound_getStatus($this->cdata));
    }
    public function setBuffer(SoundBuffer $buffer): void
    {
        $this->sfml->audio->ffi->sfSound_setBuffer($this->cdata, $buffer->asAudio());
    }
    public function getBuffer(): SoundBuffer
    {
        return new SoundBuffer($this->sfml, $this->sfml->audio->ffi->sfSound_getBuffer($this->cdata));
    }
    public function setLoop(bool $loop): void
    {
        $this->sfml->audio->ffi->sfSound_setLoop($this->cdata, $loop ? 1 : 0);
    }
    public function getLoop(): bool
    {
        return $this->sfml->audio->ffi->sfSound_getLoop($this->cdata) === 1;
    }
}