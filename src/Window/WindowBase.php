<?php

namespace iggyvolz\SFML\Window;

use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\Window\Event\Event;

class WindowBase
{
    #[\Spem("libphpsfml.so", "windowbase_construct")]
    public function __construct(
        VideoMode $mode,
        string $title,
        array $windowStyle = Style::default,
        State $state = State::Windowed,
        ?ContextSettings $contextSettings = null
    )
    {
    }
    #[\Spem("libphpsfml.so", "windowbase_fromhandle")]
    public static function fromHandle(object $handle): self {

    }
    #[\Spem("libphpsfml.so", "windowbase_close")]
    public function close(): void {}
    public bool $isOpen { #[\Spem("libphpsfml.so", "windowbase_isopen")] get{}}

    #[\Spem("libphpsfml.so", "windowbase_waitevent")]
    public function waitEvent(?Time $timeout = null): ?Event {
    }
    #[\Spem("libphpsfml.so", "windowbase_pollevent")]
    public function pollEvent(?Time $timeout = null): null|Event|true {
    }
    #[\Spem("libphpsfml.so", "windowbase_destruct")]
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}
