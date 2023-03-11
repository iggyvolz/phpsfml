<?php

namespace iggyvolz\SFML\Audio;

use FFI\CData;
use iggyvolz\SFML\Graphics\GraphicsLib;
use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\System\Vector\Vector3F;

class Sound implements SoundSource
{

    public function __construct(
        private AudioLib $audioLib,
        // sfSound*
        /** @internal  */
        private CData $cdata
    )
    {
    }
    public static function create(
        AudioLib $audioLib,
    ): self
    {
        return new self($audioLib, $audioLib->ffi->sfSound_create());
    }
    public function __clone(): void
    {
        $this->cdata = $this->audioLib->ffi->sfSound_copy($this->cdata);
    }
    public function __destruct()
    {
        $this->audioLib->ffi->sfSound_destroy($this->cdata);
    }

    public function setPitch(float $pitch): void
    {
        $this->audioLib->ffi->sfSound_setPitch($this->cdata, $pitch);
    }

    public function setVolume(float $volume): void
    {
        $this->audioLib->ffi->sfSound_setVolume($this->cdata, $volume);
    }

    public function setPosition(Vector3F $position): void
    {
        $this->audioLib->ffi->sfSound_setPosition($this->cdata, $position->cdata);
    }

    public function setRelativeToListener(bool $relative): void
    {
        $this->audioLib->ffi->sfSound_setRelativeToListener($this->cdata, $relative ? 1 : 0);
    }

    public function setMinDistance(float $distance): void
    {
        $this->audioLib->ffi->sfSound_setMinDistance($this->cdata, $distance);
    }

    public function setAttenuation(float $attenuation): void
    {
        $this->audioLib->ffi->sfSound_setAttenuation($this->cdata, $attenuation);
    }

    public function setPlayingOffset(Time $timeOffset): void
    {
        $this->audioLib->ffi->sfSound_setPlayingOffset($this->cdata, $timeOffset->cdata);
    }

    public function getPlayingOffset(): Time
    {
        return new Time($this->audioLib, $this->audioLib->ffi->sfSound_getPlayingOffset($this->cdata));
    }

    public function getPitch(): float
    {
        return $this->audioLib->ffi->sfSound_getPitch($this->cdata);
    }

    public function getVolume(): float
    {
        return $this->audioLib->ffi->sfSound_getVolume($this->cdata);
    }

    public function getPosition(): Vector3F
    {
        return new Vector3F($this->audioLib->ffi->sfSound_getPosition($this->cdata));
    }

    public function isRelativeToListener(): bool
    {
        return $this->audioLib->ffi->sfSound_isRelativeToListener($this->cdata) ? 1 : 0;
    }

    public function getMinDistance(): float
    {
        return $this->audioLib->ffi->sfSound_getMinDistance($this->cdata);
    }

    public function getAttenuation(): float
    {
        return $this->audioLib->ffi->sfSound_getAttenuation($this->cdata);
    }

    public function play(): void
    {
        $this->audioLib->ffi->sfSound_play($this->cdata);
    }

    public function pause(): void
    {
        $this->audioLib->ffi->sfSound_pause($this->cdata);
    }

    public function stop(): void
    {
        $this->audioLib->ffi->sfSound_stop($this->cdata);
    }

    public function getStatus(): SoundStatus
    {
        return SoundStatus::from($this->audioLib->ffi->sfSound_getStatus($this->cdata));
    }
    public function setBuffer(SoundBuffer $buffer): void
    {
        $this->audioLib->ffi->sfSound_setBuffer($this->cdata, $buffer->cdata);
    }
    public function getBuffer(): SoundBuffer
    {
        return new SoundBuffer($this->audioLib, $this->audioLib->ffi->sfSound_getBuffer($this->cdata));
    }
    public function setLoop(bool $loop): void
    {
        $this->audioLib->ffi->sfSound_setLoop($this->cdata, $loop ? 1 : 0);
    }
    public function getLoop(): bool
    {
        return $this->audioLib->ffi->sfSound_getLoop($this->cdata) === 1;
    }
}