<?php

namespace iggyvolz\SFML\Utils;

use Attribute;

#[Attribute]
final readonly class CType
{
    public function __construct(public string $type)
    {
    }
}