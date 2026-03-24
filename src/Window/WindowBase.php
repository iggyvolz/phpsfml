<?php

namespace iggyvolz\SFML\Window;

use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\Window\Event\Event;

class WindowBase
{
    #[\Spem("windowbase_construct")]
    public function __construct(
        VideoMode $mode,
        string $title,
        array $windowStyle = Style::default,
        State $state = State::Windowed
    )
    {
    }
    #[\Spem("windowbase_fromhandle")]
    public static function fromHandle(object $handle): self {

    }
    #[\Spem("windowbase_close")]
    public function close(): void {}
    public bool $isOpen { #[\Spem("windowbase_isopen")] get{}}

    #[\Spem("windowbase_waitevent")]
    public function waitEvent(?Time $timeout = null): ?Event {
    }
    #[\Spem("windowbase_pollevent")]
    public function pollEvent(?Time $timeout = null): null|Event {
    }

    /**
     * @var array{0:int,1:int}
     */
    public array $size {
        #[\Spem("windowbase_getsize")] get {}
        #[\Spem("windowbase_setsize")] set(array $size) {}
    }

    /**
     * @var array{0:int,1:int}
     */
    public array $position {
        #[\Spem("windowbase_getPosition")] get {}
        #[\Spem("windowbase_setPosition")] set {}
    }

    /**
     * @var null|array{0:int,1:int}
     */
    public ?array $minimumSize {
        #[\Spem("windowbase_setMinimumSize")] set {}
    }

    /**
     * @var null|array{0:int,1:int}
     */
    public ?array $maximumSize {
        #[\Spem("windowbase_setMaximumSize")] set {}
    }

    public string $title {
        #[\Spem("windowbase_setTitle")] set {}
    }

    #[\Spem("windowbase_setIcon")]
    public function setIcon(int $width, int $height, string $pixels): void {}

    public bool $visible {
        #[\Spem("windowbase_setVisible")] set{}
    }
    public bool $mouseCursorVisible {
        #[\Spem("windowbase_setMouseCursorVisible")] set{}
    }
    public bool $mouseCursorGrabbed {
        #[\Spem("windowbase_setMouseCursorGrabbed")] set{}
    }
    public Cursor $mouseCursor {
        #[\Spem("windowbase_setMouseCursor")] set {}
    }

    public bool $keyRepeatEnabled {
        #[\Spem("windowbase_setKeyRepeatEnabled")] set {}
    }

    public float $joystickThreshold {
        #[\Spem("windowbase_setJoystickThreshold")] set {}
    }

    #[\Spem("windowbase_requestFocus")]
    public function requestFocus(): void {}

    public bool $hasFocus { #[\Spem("windowbase_hasFocus")] get {}}

    /**
     * @template T
     * @param class-string<T> $class
     * @return T
     */
    #[\Spem("windowbase_getNativeHandle")]
    public function getNativeHandle(string $class): object {}

    /**
     * @template T
     * @param object $instance
     * @param class-string<T> $surfaceClass
     * @param object|null $allocator
     * @return ?T
     */
    #[\Spem("windowbase_createVulkanSurface")]
    public function createVulkanSurface(object $instance, string $surfaceClass, ?object $allocator = null): ?object {}

    #[\Spem("windowbase_destruct")]
    public function __destruct()
    {
    }
}
