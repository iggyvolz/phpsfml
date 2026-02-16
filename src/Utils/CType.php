<?php

namespace iggyvolz\SFML\Utils;

use Attribute;

#[Attribute]
#[\Deprecated]
final readonly class CType
{
    public function __construct(public string $type)
    {
    }
}