<?php

namespace iggyvolz\SFML\Window;

use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\Utils\SfString;
use iggyvolz\SFML\Window\Event\Event;

class WindowBase
{
    #[\Spem("libphpsfml.so", "windowbase_construct")]
    public function __construct(
        VideoMode $mode,
        SfString $title,
        array $windowStyle = Style::default,
        State $state = State::Windowed
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

    /**
     * @var array{0:int,1:int}
     */
    public array $size {
        #[\Spem("libphpsfml.so", "windowbase_getsize")] get {}
        #[\Spem("libphpsfml.so", "windowbase_setsize")] set(array $size) {}
    }

    /**
     * @var array{0:int,1:int}
     */
    public array $position {
        #[\Spem("libphpsfml.so", "windowbase_getPosition")] get {}
        #[\Spem("libphpsfml.so", "windowbase_setPosition")] set {}
    }

    /**
     * @var null|array{0:int,1:int}
     */
    public ?array $minimumSize {
        #[\Spem("libphpsfml.so", "windowbase_setMinimumSize")] set {}
    }

    /**
     * @var null|array{0:int,1:int}
     */
    public ?array $maximumSize {
        #[\Spem("libphpsfml.so", "windowbase_setMaximumSize")] set {}
    }

    public SfString $title {
        #[\Spem("libphpsfml.so", "windowbase_setTitle")] set {}
    }

    #[\Spem("libphpsfml.so", "windowbase_setIcon")]
    public function setIcon(int $width, int $height, string $pixels): void {}

    public bool $visible {
        #[\Spem("libphpsfml.so", "windowbase_setVisible")] set{}
    }
    public bool $mouseCursorVisible {
        #[\Spem("libphpsfml.so", "windowbase_setMouseCursorVisible")] set{}
    }
    public bool $mouseCursorGrabbed {
        #[\Spem("libphpsfml.so", "windowbase_setMouseCursorGrabbed")] set{}
    }
    public Cursor $mouseCursor {
        #[\Spem("libphpsfml.so", "windowbase_setMouseCursor")] set {}
    }

    public bool $keyRepeatEnabled {
        #[\Spem("libphpsfml.so", "windowbase_setKeyRepeatEnabled")] set {}
    }

    public float $joystickThreshold {
        #[\Spem("libphpsfml.so", "windowbase_setJoystickThreshold")] set {}
    }

    #[\Spem("libphpsfml.so", "windowbase_requestFocus")]
    public function requestFocus(): void {}

    public bool $hasFocus { #[\Spem("libphpsfml.so", "windowbase_hasFocus")] get {}}

    /**
     * @template T
     * @param class-string<T> $class
     * @return T
     */
    #[\Spem("libphpsfml.so", "windowbase_getNativeHandle")]
    public function getNativeHandle(string $class): object {}

    /**
     * @template T
     * @param object $instance
     * @param class-string<T> $surfaceClass
     * @param object|null $allocator
     * @return ?T
     */
    #[\Spem("libphpsfml.so", "windowbase_createVulkanSurface")]
    public function createVulkanSurface(object $instance, string $surfaceClass, ?object $allocator = null): ?object {}

    #[\Spem("libphpsfml.so", "windowbase_destruct")]
    public function __destruct()
    {
    }
}
