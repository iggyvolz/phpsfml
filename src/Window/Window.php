<?php

namespace iggyvolz\SFML\Window;

use iggyvolz\SFML\Utils\SfString;

class Window extends WindowBase
{

    #[\Spem("libphpsfml.so", "window_construct")]
    public function __construct(
        VideoMode $mode,
        SfString $title,
        array $windowStyle = Style::default,
        State $state = State::Windowed,
        ContextSettings $settings = new ContextSettings(),
    )
    {
    }

    public ContextSettings $settings {
        #[\Spem("libphpsfml.so", "window_getSettings")] get {}
    }

    public bool $verticalSyncEnabled {
        #[\Spem("libphpsfml.so", "window_setVerticalSyncEnabled")] set {}
    }

    public int $framerateLimit {
        #[\Spem("libphpsfml.so", "window_setFramerateLimit")] set {}
    }

    #[\Spem("libphpsfml.so", "window_display")]
    public function display(): void {}

}