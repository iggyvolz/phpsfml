<?php

namespace iggyvolz\SFML\Audio;

use FFI;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\InputStream;
use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\System\Vector\Vector3F;
use iggyvolz\SFML\Utils\CType;

#[CType("sfMusic")]
class Music extends AudioObject implements SoundSource
{
    public static function createFromFile(Sfml $sfml, string $filename): ?self
    {
        return new self($sfml, $sfml->audio->ffi->sfMusic_createFromFile($filename));
    }

    public static function createFromMemory(Sfml $sfml, string $data): ?self
    {
        $len = strlen($data);
        $dataPtr = $sfml->audio->ffi->new("char[$len]");
        FFI::memcpy($dataPtr, $data, $len);
        return new self($sfml, $sfml->audio->ffi->sfMusic_createFromMemory(FFI::cast("void*", FFI::addr($dataPtr)), $len));
    }

    public static function createFromStream(Sfml $sfml, InputStream $stream): ?self
    {
        return new self($sfml, $sfml->audio->ffi->sfMusic_createFromStream($stream->asAudio()));
    }

    public function __destruct()
    {
        $this->sfml->audio->ffi->sfMusic_destroy($this->cdata);
    }

    public function setPitch(float $pitch): void
    {
        $this->sfml->audio->ffi->sfMusic_setPitch($this->cdata, $pitch);
    }

    public function setVolume(float $volume): void
    {
        $this->sfml->audio->ffi->sfMusic_setVolume($this->cdata, $volume);
    }

    public function setPosition(Vector3F $position): void
    {
        $this->sfml->audio->ffi->sfMusic_setPosition($this->cdata, $position->asAudio());
    }

    public function setRelativeToListener(bool $relative): void
    {
        $this->sfml->audio->ffi->sfMusic_setRelativeToListener($this->cdata, $relative ? 1 : 0);
    }

    public function setMinDistance(float $distance): void
    {
        $this->sfml->audio->ffi->sfMusic_setMinDistance($this->cdata, $distance);
    }

    public function setAttenuation(float $attenuation): void
    {
        $this->sfml->audio->ffi->sfMusic_setAttenuation($this->cdata, $attenuation);
    }

    public function getPitch(): float
    {
        return $this->sfml->audio->ffi->sfMusic_getPitch($this->cdata);
    }

    public function getVolume(): float
    {
        return $this->sfml->audio->ffi->sfMusic_getVolume($this->cdata);
    }

    public function getPosition(): Vector3F
    {
        return new Vector3F($this->sfml, $this->sfml->audio->ffi->sfMusic_getVolume($this->cdata), true);
    }

    public function isRelativeToListener(): bool
    {
        return $this->sfml->audio->ffi->sfMusic_isRelativeToListener($this->cdata) === 1;
    }

    public function getMinDistance(): float
    {
        return $this->sfml->audio->ffi->sfMusic_getMinDistance($this->cdata);
    }

    public function getAttenuation(): float
    {
        return $this->sfml->audio->ffi->sfMusic_getAttenuation($this->cdata);
    }

    public function play(): void
    {
        $this->sfml->audio->ffi->sfMusic_play($this->cdata);
    }

    public function pause(): void
    {
        $this->sfml->audio->ffi->sfMusic_pause($this->cdata);
    }

    public function stop(): void
    {
        $this->sfml->audio->ffi->sfMusic_stop($this->cdata);
    }

    public function getStatus(): SoundStatus
    {
        return SoundStatus::from($this->sfml->audio->ffi->sfMusic_getStatus($this->cdata));
    }

    public function setLoop(bool $loop): void
    {
        $this->sfml->audio->ffi->sfMusic_setLoop($this->cdata, $loop ? 1 : 0);
    }

    public function getLoop(): bool
    {
        return $this->sfml->audio->ffi->sfMusic_getLoop($this->cdata) === 1;
    }

    public function getDuration(): Time
    {
        return new Time($this->sfml, $this->sfml->audio->ffi->sfMusic_getDuration($this->cdata), true);
    }

    public function getLoopPoints(): TimeSpan
    {
        return new TimeSpan($this->sfml, $this->sfml->audio->ffi->sfMusic_getLoopPoints($this->cdata));
    }

    public function setLoopPoints(TimeSpan $timePoints): void
    {
        $this->sfml->audio->ffi->sfMusic_setLoopPoints($this->cdata, $timePoints->asAudio());
    }

    public function getChannelCount(): int
    {
        return $this->sfml->audio->ffi->sfMusic_getChannelCount($this->cdata);
    }

    public function getSampleRate(): int
    {
        return $this->sfml->audio->ffi->sfMusic_getSampleRate($this->cdata);
    }

    public function getPlayingOffset(): Time
    {
        return new Time($this->sfml, $this->sfml->audio->ffi->sfMusic_getPlayingOffset($this->cdata), true);
    }

    public function setPlayingOffset(Time $timeOffset): void
    {
        $this->sfml->audio->ffi->sfMusic_setPlayingOffset($this->cdata, $timeOffset->asAudio());
    }
}