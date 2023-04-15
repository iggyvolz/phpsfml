<?php

namespace iggyvolz\SFML\Audio;

use iggyvolz\SFML\System\Vector\Vector3F;

readonly final class Listener
{
    /** @internal  */
    public function __construct(public AudioLib $audio)
    {
    }
    public function setGlobalVolume(float $volume): void
    {
        $this->audio->ffi->sfListener_setGlobalVolume($volume);
    }
    public function getGlobalVolume(): float
    {
        return $this->audio->ffi->sfListener_getGlobalVolume();
    }
    public function setPosition(Vector3F $position): void
    {
        $this->audio->ffi->sfListener_setPosition($position->asAudio());
    }
    public function getPosition(): Vector3F
    {
        return new Vector3F($this->audio->sfml, $this->audio->ffi->sfListener_getPosition(), true);
    }
    public function setDirection(Vector3F $direction): void
    {
        $this->audio->ffi->sfListener_setDirection($direction->asAudio());
    }
    public function getDirection(): Vector3F
    {
        return new Vector3F($this->audio->sfml, $this->audio->ffi->sfListener_getDirection(), true);
    }
    public function setUpVector(Vector3F $upVector): void
    {
        $this->audio->ffi->sfListener_setUpVector($upVector->asAudio());
    }
    public function getUpVector(): Vector3F
    {
        return new Vector3F($this->audio->sfml, $this->audio->ffi->sfListener_getUpVector(), true);
    }
}