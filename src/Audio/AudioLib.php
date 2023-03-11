<?php

namespace iggyvolz\SFML\Audio;
use FFI;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\System\Vector\Vector3F;
use iggyvolz\SFML\Window\WindowLib;

readonly class AudioLib
{
    public FFI $ffi;
    public function __construct(string $libPath)
    {
        $this->ffi = FFI::cdef(file_get_contents(__DIR__ . "/Audio.h"), $libPath);
    }
    public function setGlobalVolume(float $volume): void
    {
        $this->ffi->sfListener_setGlobalVolume($volume);
    }
    public function getGlobalVolume(): float
    {
        return $this->ffi->sfListener_getGlobalVolume();
    }
    public function setPosition(Vector3F $position): void
    {
        $this->ffi->sfListener_setPosition($position->cdata);
    }
    public function getPosition(): Vector3F
    {
        return new Vector3F($this->ffi->sfListener_getPosition());
    }
    public function setDirection(Vector3F $direction): void
    {
        $this->ffi->sfListener_setDirection($direction->cdata);
    }
    public function getDirection(): Vector3F
    {
        return new Vector3F($this->ffi->sfListener_getDirection());
    }
    public function setUpVector(Vector3F $upVector): void
    {
        $this->ffi->sfListener_setUpVector($upVector->cdata);
    }
    public function getUpVector(): Vector3F
    {
        return new Vector3F($this->ffi->sfListener_getUpVector());
    }
}
