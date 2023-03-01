<?php

namespace iggyvolz\SFML\Window;

use FFI;
use FFI\CData;
use iggyvolz\SFML\Utils\UTF32;

class Window
{
    public function __construct(
        private readonly WindowLib $windowLib,
        // sfWindow*
        private readonly CData $cdata
    )
    {
    }

    /**
     * @param list<WindowStyle> $windowStyle
     */
    public static function create(
        WindowLib $windowLib,
        string $title,
        ?VideoMode $videoMode = null,
        array $windowStyle = WindowStyle::default,
        ?ContextSettings $contextSettings = null,
        string $titleEncoding = "UTF-8",
    ): self
    {
        $videoMode ??= VideoMode::getDesktopMode($windowLib);
        $contextSettings ??= $contextSettings ?? ContextSettings::create($windowLib);
        return new self($windowLib, $windowLib->ffi->sfWindow_createUnicode(
            $videoMode->cdata,
            UTF32::fromString($title, $titleEncoding)->cdata,
            WindowStyle::toInt(...$windowStyle),
            FFI::addr($contextSettings->cdata),
        ));
    }

    /**
     * Close a window and destroy all the attached resources
     * After calling this function, the sfWindow object remains
     * valid, you must call sfWindow_destroy to actually delete it.
     * All other functions such as sfWindow_pollEvent or sfWindow_display
     * will still work (i.e. you don't have to test sfWindow_isOpen
     * every time), and will have no effect on closed windows.
     * @return void
     */
    public function close(): void
    {
        $this->windowLib->ffi->sfWindow_close($this->cdata);
    }

    /**
     * Tell whether or not a window is opened
     *
     * This function returns whether or not the window exists.
     * Note that a hidden window (setVisible(false)) will return true
     *
     * @return bool true if the window is opened, false if it has been closed
     */
    public function isOpen(): bool
    {
        return $this->windowLib->ffi->sfWindow_isOpen($this->cdata) === 1;
    }

    /**
     * Get the settings of the OpenGL context of a window
     *
     * Note that these settings may be different from what was
     * passed to the create function,
     * if one or more settings were not supported. In this case,
     * SFML chose the closest match.
     *
     * @return ContextSettings Structure containing the OpenGL context settings
     */
    public function getSettings(): ContextSettings
    {
        return new ContextSettings($this->windowLib, $this->windowLib->ffi->sfWindow_getSettings($this->cdata));
    }

    /**
     * Pop the event on top of event queue, if any, and return it
     * This function is not blocking: if there's no pending event then
     * it will return null
     * Note that more than one event may be present in the event queue,
     * thus you should always call this function in a loop
     * to make sure that you process every pending event.
     * @return Event|null The event if an event was returned, or sfFalse if the event queue was empty
     */
    public function pollEvent(): ?Event
    {
        $event = $this->windowLib->ffi->new("sfEvent");
        $success = $this->windowLib->ffi->sfWindow_pollEvent($this->cdata, FFI::addr($event)) === 1;
        if($success) {
            return new Event($this->windowLib, $event);
        } else {
            return null;
        }
    }

    /**
     * Destroy a window
     */
    public function __destruct()
    {
        $this->windowLib->ffi->sfWindow_destroy($this->cdata);
    }
}