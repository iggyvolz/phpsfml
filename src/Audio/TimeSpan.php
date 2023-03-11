<?php

namespace iggyvolz\SFML\Audio;

use FFI\CData;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Time;

readonly class TimeSpan
{
    public function __construct(
        private AudioLib $audioLib,
        // sfTimeSpan
        /**
         * @internal
         */
        public CData $cdata
    )
    {
    }

    public static function create(AudioLib $audioLib, Time $offset, Time $length): self
    {
        $vector = $audioLib->ffi->new("sfTimeSpan");
        $vector->offset = $offset;
        $vector->length = $length;
        return new self($audioLib, $vector);
    }

    public function getOffset(): Time
    {
        return new Time($this->audioLib, $this->cdata->offset);
    }

    public function getLength(): Time
    {
        return new Time($this->audioLib, $this->cdata->length);
    }
}