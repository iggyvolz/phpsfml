<?php

namespace iggyvolz\SFML\Window;

class Window extends WindowBase
{

    #[\Spem("window_construct")]
    public function __construct(
        VideoMode $mode,
        string $title,
        array $windowStyle = Style::default,
        State $state = State::Windowed,
        ContextSettings $settings = new ContextSettings(),
    )
    {
    }

    public ContextSettings $settings {
        #[\Spem("window_getSettings")] get {}
    }

    public bool $verticalSyncEnabled {
        #[\Spem("window_setVerticalSyncEnabled")] set {}
    }

    public int $framerateLimit {
        #[\Spem("window_setFramerateLimit")] set {}
    }

    #[\Spem("window_display")]
    public function display(): void {}

}