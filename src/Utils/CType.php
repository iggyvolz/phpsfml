<?php

namespace iggyvolz\SFML\Utils;

#[\Attribute]
final readonly class CType
{
    public function __construct(public string $type)
    {
    }
}