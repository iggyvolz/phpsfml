<?php

namespace iggyvolz\SFML\Audio;

use FFI;
use FFI\CData;
use iggyvolz\SFML\System\InputStream;
use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\System\Vector\Vector3F;

class Music implements SoundSource
{
    public function __construct(
        public AudioLib $audioLib,
        // sfMusic*
        public CData $cdata
    )
    {
    }

    public static function createFromFile(AudioLib $audioLib, string $filename): ?self
    {
        return new self($audioLib, $audioLib->ffi->sfMusic_createFromFile($filename));
    }

    public static function createFromMemory(AudioLib $audioLib, string $data): ?self
    {
        $len = strlen($data);
        $dataPtr = FFI::new("char[$len]");
        FFI::memcpy($dataPtr, $data, $len);
        return new self($audioLib, $audioLib->ffi->sfMusic_createFromMemory(FFI::cast("void*", FFI::addr($dataPtr)), $len));
    }

    public static function createFromStream(AudioLib $audioLib, InputStream $stream): ?self
    {
        return new self($audioLib, $audioLib->ffi->sfMusic_createFromStream($stream->cdata));
    }

    public function __destruct()
    {
        $this->audioLib->ffi->sfMusic_destroy($this->cdata);
    }

    public function setPitch(float $pitch): void
    {
        $this->audioLib->ffi->sfMusic_setPitch($this->cdata, $pitch);
    }

    public function setVolume(float $volume): void
    {
        $this->audioLib->ffi->sfMusic_setVolume($this->cdata, $volume);
    }

    public function setPosition(Vector3F $position): void
    {
        $this->audioLib->ffi->sfMusic_setPosition($this->cdata, $position->cdata);
    }

    public function setRelativeToListener(bool $relative): void
    {
        $this->audioLib->ffi->sfMusic_setRelativeToListener($this->cdata, $relative ? 1 : 0);
    }

    public function setMinDistance(float $distance): void
    {
        $this->audioLib->ffi->sfMusic_setMinDistance($this->cdata, $distance);
    }

    public function setAttenuation(float $attenuation): void
    {
        $this->audioLib->ffi->sfMusic_setAttenuation($this->cdata, $attenuation);
    }

    public function getPitch(): float
    {
        return $this->audioLib->ffi->sfMusic_getPitch($this->cdata);
    }

    public function getVolume(): float
    {
        return $this->audioLib->ffi->sfMusic_getVolume($this->cdata);
    }

    public function getPosition(): Vector3F
    {
        return new Vector3F($this->audioLib->ffi->sfMusic_getVolume($this->cdata));
    }

    public function isRelativeToListener(): bool
    {
        return $this->audioLib->ffi->sfMusic_isRelativeToListener($this->cdata) === 1;
    }

    public function getMinDistance(): float
    {
        return $this->audioLib->ffi->sfMusic_getMinDistance($this->cdata);
    }

    public function getAttenuation(): float
    {
        return $this->audioLib->ffi->sfMusic_getAttenuation($this->cdata);
    }

    public function play(): void
    {
        $this->audioLib->ffi->sfMusic_play($this->cdata);
    }

    public function pause(): void
    {
        $this->audioLib->ffi->sfMusic_pause($this->cdata);
    }

    public function stop(): void
    {
        $this->audioLib->ffi->sfMusic_stop($this->cdata);
    }

    public function getStatus(): SoundStatus
    {
        return SoundStatus::from($this->audioLib->ffi->sfMusic_getStatus($this->cdata));
    }
    public function setLoop(bool $loop): void
    {
        $this->audioLib->ffi->sfMusic_setLoop($this->cdata, $loop ? 1 : 0);
    }
    public function getLoop(): bool
    {
        return $this->audioLib->ffi->sfMusic_getLoop($this->cdata) === 1;
    }
    public function getDuration(): Time
    {
        return new Time($this->audioLib, $this->audioLib->ffi->sfMusic_getDuration($this->cdata));
    }
    public function getLoopPoints(): TimeSpan
    {
        return new TimeSpan($this->audioLib, $this->audioLib->ffi->sfMusic_getLoopPoints($this->cdata));
    }
    public function setLoopPoints(TimeSpan $timePoints): void
    {
        $this->audioLib->ffi->sfMusic_setLoopPoints($this->cdata, $timePoints->cdata);
    }
    public function getChannelCount(): int
    {
        return $this->audioLib->ffi->sfMusic_getChannelCount($this->cdata);
    }
    public function getSampleRate(): int
    {
        return $this->audioLib->ffi->sfMusic_getSampleRate($this->cdata);
    }
    public function getPlayingOffset(): Time
    {
        return new Time($this->audioLib, $this->audioLib->ffi->sfMusic_getPlayingOffset($this->cdata));
    }
    public function setPlayingOffset(Time $timeOffset): void
    {
        $this->audioLib->ffi->sfMusic_setPlayingOffset($this->cdata, $timeOffset->cdata);
    }
}