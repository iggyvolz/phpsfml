<?php

namespace iggyvolz\SFML\Window;

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
    #[\Spem("libphpsfml.so", "windowbase_destruct")]
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}
