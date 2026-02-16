<?php

namespace iggyvolz\SFML\Utils;

use FFI\CData;
use JetBrains\PhpStorm\Deprecated;

#[Deprecated]
interface ISfmlObject
{
    /**
     * @internal
     */
    public function asAudio(): CData;
    /**
     * @internal
     */
    public function asGraphics(): CData;
    /**
     * @internal
     */
    public function asNetwork(): CData;
    /**
     * @internal
     */
    public function asSystem(): CData;
    /**
     * @internal
     */
    public function asWindow(): CData;
}