<?php

namespace iggyvolz\SFML\Audio;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\Utils\CType;

#[CType("sfTimeSpan")]
class TimeSpan extends AudioObject
{
    public static function create(Sfml $sfml, Time $offset, Time $length): self
    {
        $vector = $sfml->audio->ffi->new("sfTimeSpan");
        $vector->offset = $offset;
        $vector->length = $length;
        return new self($sfml, $vector);
    }

    public function getOffset(): Time
    {
        return new Time($this->sfml, $this->cdata->offset);
    }

    public function getLength(): Time
    {
        return new Time($this->sfml, $this->cdata->length);
    }
}