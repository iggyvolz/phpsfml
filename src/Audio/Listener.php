<?php

namespace iggyvolz\SFML\Audio;

use Spem;

final class Listener
{
    /** @internal  */
    private function __construct() {}
    private static ?Listener $listener = null;
    public static function get(): self {
        return self::$listener ??= new self();
    }
    public float $globalVolume {#[Spem] get{} #[Spem] set{}}
    /** @var array{0:float,1:float,2:float} */
    public array $position {#[Spem] get{} #[Spem] set{}}
    /** @var array{0:float,1:float,2:float} */
    public array $direction {#[Spem] get{} #[Spem] set{}}
    /** @var array{0:float,1:float,2:float} */
    public array $upVector {#[Spem] get{} #[Spem] set{}}
}