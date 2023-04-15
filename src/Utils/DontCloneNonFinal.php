<?php

namespace iggyvolz\SFML\Utils;

use Dont\DontClone;
use Dont\Exception\NonCloneableObject;
use Dont\Exception\TypeError;

/**
 * @see DontClone
 * Except non-final (can be overridden)
 */
trait DontCloneNonFinal
{
    /**
     * @throws NonCloneableObject
     * @throws TypeError
     */
    public function __clone()
    {
        throw NonCloneableObject::fromAttemptedCloning($this);
    }
}