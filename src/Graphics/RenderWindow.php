<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use FFI\CData;
use iggyvolz\SFML\Event\Event;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\System\Vector\Vector2I;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Utils\PixelArray;
use iggyvolz\SFML\Utils\UTF32;
use iggyvolz\SFML\Window\ContextSettings;
use iggyvolz\SFML\Window\Cursor;
use iggyvolz\SFML\Window\VideoMode;
use iggyvolz\SFML\Window\Window;
use iggyvolz\SFML\Window\WindowLib;
use iggyvolz\SFML\Window\WindowStyle;

class RenderWindow implements Window, RenderTarget
{
    public function __construct(
        private readonly GraphicsLib $graphicsLib,
        // sfRenderWindow*
        /** @internal  */
        public readonly CData $cdata
    )
    {
    }

    public static function create(
        GraphicsLib $graphicsLib,
        WindowLib $windowLib,
        string $title,
        ?VideoMode $videoMode = null,
        array $windowStyle = WindowStyle::default,
        ?ContextSettings $contextSettings = null,
        string $titleEncoding = "UTF-8",
    ): RenderWindow
    {

        $videoMode ??= VideoMode::getDesktopMode($windowLib);
        $contextSettings ??= $contextSettings ?? ContextSettings::create($windowLib);
        $self = new self($graphicsLib, $graphicsLib->ffi->sfRenderWindow_createUnicode(
            $graphicsLib->ffi->cast("sfVideoMode", $videoMode->cdata),
            UTF32::fromString($title, $titleEncoding)->cdata,
            WindowStyle::toInt(...$windowStyle),
            FFI::addr($graphicsLib->ffi->cast("sfContextSettings", $contextSettings->cdata)),
        ));
        return $self;
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfRenderWindow_destroy($this->cdata);
    }

    public function clear(?Color $color = null): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_clear($this->cdata, ($color ?? Color::createFromRGBA($this->graphicsLib, 0, 0, 0, 255))->cdata);
    }

    public function setView(View $view): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setView($this->cdata, $view->cdata);
    }

    public function getView(): View
    {
        return new View($this->graphicsLib, $this->graphicsLib->ffi->sfRenderWindow_getView($this->cdata));
    }

    public function getDefaultView(): View
    {
        return new View($this->graphicsLib, $this->graphicsLib->ffi->sfRenderWindow_getDefaultView($this->cdata));
    }

    public function getViewport(View $view): IntRect
    {
        return new IntRect($this->graphicsLib, $this->graphicsLib->ffi->sfRenderWindow_getViewport($this->cdata, $view->cdata));
    }

    public function mapPixelToCoords(Vector2I $point, ?View $view = null): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfRenderWindow_mapPixelToCoords($this->cdata, $point->cdata, $view?->cdata));
    }

    public function mapCoordsToPixel(Vector2F $point, ?View $view = null): Vector2I
    {
        return new Vector2I($this->graphicsLib->ffi->sfRenderWindow_mapCoordsToPixel($this->cdata, $point->cdata, $view?->cdata));
    }

    public function draw(Drawable $drawable, ?RenderStates $renderStates = null): void
    {
        $drawable->draw($this, $renderStates);
    }

    public function pushGLStates(): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_pushGLStates($this->cdata);
    }

    public function popGLStates(): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_popGLStates($this->cdata);
    }

    public function resetGLStates(): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_resetGLStates($this->cdata);
    }

    /**
     * Close a window and destroy all the attached resources
     * After calling this function, the sfWindow object remains
     * valid, it will not be deleted until the destructor is called.
     * All other functions such as pollEvent or display
     * will still work (i.e. you don't have to test sfRenderWindow_isOpen
     * every time), and will have no effect on closed windows.
     * @return void
     */
    public function close(): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_close($this->cdata);
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
        return $this->graphicsLib->ffi->sfRenderWindow_isOpen($this->cdata) === 1;
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
        return new ContextSettings($this->graphicsLib->ffi->sfRenderWindow_getSettings($this->cdata));
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
        $event = $this->graphicsLib->ffi->new("sfEvent");
        $success = $this->graphicsLib->ffi->sfRenderWindow_pollEvent($this->cdata, FFI::addr($event)) === 1;
        if($success) {
            return Event::create($this, $event);
        } else {
            return null;
        }
    }

    /**
     * Wait for an event and return it
     *
     * This function is blocking: if there's no pending event then
     * it will wait until an event is received.
     * After this function returns (and no error occured),
     * the \a event object is always valid and filled properly.
     * This function is typically used when you have a thread that
     * is dedicated to events handling: you want to make this thread
     * sleep as long as no new event is received.
     * @return Event|null
     */
    public function waitEvent(): ?Event
    {
        $event = $this->graphicsLib->ffi->new("sfEvent");
        $success = $this->graphicsLib->ffi->sfRenderWindow_waitEvent($this->cdata, FFI::addr($event)) === 1;
        if($success) {
            return Event::create($this, $event);
        } else {
            return null;
        }
    }

    /**
     * Get the position of a window
     *
     * @return Vector2I Position in pixels
     */
    public function getPosition(): Vector2I
    {
        return new Vector2I($this->graphicsLib->ffi->sfRenderWindow_getPosition($this->cdata));
    }

    /**
     * Change the position of a window on screen
     *
     * This function only works for top-level windows
     * (i.e. it will be ignored for windows created from
     * the handle of a child window/control).
     * @param Vector2I $position New position of the window, in pixels
     */
    public function setPosition(Vector2I $position): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setPosition($this->cdata, $position->cdata);
    }

    /**
     * Get the size of the render region of a window
     *
     * The size doesn't include the titlebar and borders
     * of the window.
     * @return Vector2U Size, in pixels
     */
    public function getSize(): Vector2U
    {
        return new Vector2U($this->graphicsLib->ffi->sfRenderWindow_getSize($this->cdata));
    }

    /**
     * Change the size of the rendering region of a window
     *
     * @param Vector2U $size New size, in pixels
     */
    public function setSize(Vector2U $size): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setSize($this->cdata, $size->cdata);
    }

    /**
     * Change the title of a window (with a UTF-32 string)
     * @param string $title New title
     * @param string $encoding Encoding of $title
     */
    public function setTitle(string $title, string $encoding = "UTF-8"): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setUnicodeTitle($this->cdata, UTF32::fromString($title, $encoding)->cdata);
    }

    /**
     * Change a window's icon
     *
     * @param PixelArray $pixels A mxn-dimensional array of pixels, grouped by row, in 32-bits RGBA format
     * @return void
     */
    public function setIcon(PixelArray $pixels): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setIcon($this->cdata, $pixels->width, $pixels->height, $pixels->cdata);
    }

    /**
     * Show or hide a window
     * @param bool $visible True to show the window, false to hide it
     */
    public function setVisible(bool $visible): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setVisible($this->cdata, $visible?1:0);
    }

    /**
     * Enable or disable vertical synchronization
     *
     * Activating vertical synchronization will limit the number
     * of frames displayed to the refresh rate of the monitor.
     * This can avoid some visual artifacts, and limit the framerate
     * to a good value (but not constant across different computers).
     * @param bool $enabled True to enable v-sync, false to deactivate
     */
    public function setVerticalSyncEnabled(bool $enabled): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setVerticalSyncEnabled($this->cdata, $enabled?1:0);
    }

    /**
     * Show or hide the mouse cursor
     * @param bool $visible True to show, false to hide
     */
    public function setMouseCursorVisible(bool $visible): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setMouseCursorVisible($this->cdata, $visible?1:0);
    }

    /**
     * Grab or release the mouse cursor
     *
     * If set, grabs the mouse cursor inside this window's client
     * area so it may no longer be moved outside its bounds.
     * Note that grabbing is only active while the window has
     * focus and calling this function for fullscreen windows
     * won't have any effect (fullscreen windows always grab the
     * cursor).
     * @param bool $grabbed True to enable, false to disable
     */
    public function setMouseCursorGrabbed(bool $grabbed): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setMouseCursorGrabbed($this->cdata, $grabbed?1:0);
    }

    /**
     * Keeping a reference to the current cursor to ensure it cannot be deleted
     */
    private ?Cursor $cursor = null;

    /**
     * Set the displayed cursor to a native system cursor
     *
     * Upon window creation, the arrow cursor is used by default.
     * @param Cursor $cursor Cursor to display
     * @return void
     */
    public function setMouseCursor(Cursor $cursor): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setMouseCursor($this->cdata, $cursor->cdata);
        $this->cursor = $cursor;
    }

    /**
     * Enable or disable automatic key-repeat
     *
     * If key repeat is enabled, you will receive repeated
     * KeyPress events while keeping a key pressed. If it is disabled,
     * you will only get a single event when the key is pressed.
     * @param bool $enabled True to enable, False to disable
     */
    public function setKeyRepeatEnabled(bool $enabled): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setKeyRepeatEnabled($this->cdata, $enabled?1:0);
    }

    /**
     * Limit the framerate to a maximum fixed frequency
     *
     * If a limit is set, the window will use a small delay after
     * each call to display to ensure that the current frame
     * lasted long enough to match the framerate limit.
     *
     * @param null|int $limit Framerate limit, in frames per seconds (use null to disable limit)
     */
    public function setFramerateLimit(?int $limit): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setFramerateLimit($this->cdata, $limit ?? 0);
    }

    /**
     * Change the joystick threshold
     *
     * The joystick threshold is the value below which
     * no JoyMoved event will be generated
     * @param float $threshold New threshold, in the range [0, 100]
     * @return void
     */
    public function setJoystickThreshold(float $threshold): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_setJoystickThreshold($this->cdata, $threshold);
    }

    /**
     * Activate or deactivate a window as the current target for OpenGL rendering
     *
     * A window is active only on the current thread, if you want to
     * make it active on another thread you have to deactivate it
     * on the previous thread first if it was active.
     * Only one window can be active on a thread at a time, thus
     * the window previously active (if any) automatically gets deactivated.
     * This is not to be confused with requestFocus().
     * @param bool $active
     * @return bool
     */
    public function setActive(bool $active = true): bool
    {
        return $this->graphicsLib->ffi->sfRenderWindow_setActive($this->cdata, $active ? 1 : 0) === 1;
    }

    /**
     * Request the current window to be made the active foreground window
     * At any given time, only one window may have the input focus
     * to receive input events such as keystrokes or mouse events.
     * If a window requests focus, it only hints to the operating
     * system, that it would like to be focused. The operating system
     * is free to deny the request.
     * This is not to be confused with setActive().
     */
    public function requestFocus(): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_requestFocus($this->cdata);
    }

    /**
     * Check whether the window has the input focus
     *
     * At any given time, only one window may have the input focus
     * to receive input events such as keystrokes or most mouse
     * events.
     * @return bool True if window has focus, false otherwise
     */
    public function hasFocus(): bool
    {
        return $this->graphicsLib->ffi->sfRenderWindow_hasFocus($this->cdata) === 1;
    }

    /**
     * Display on screen what has been rendered to the window so far
     *
     * This function is typically called after all OpenGL rendering
     * has been done for the current frame, in order to show
     * it on screen.
     */
    public function display(): void
    {
        $this->graphicsLib->ffi->sfRenderWindow_display($this->cdata);
    }

    /**
     * Get the OS-specific handle of the window
     *
     * You shouldn't need to use this function, unless you have
     * very specific stuff to implement that SFML doesn't support,
     * or implement a temporary workaround until a bug is fixed.
     */
    public function getSystemHandle(): int
    {
        return $this->graphicsLib->ffi->sfRenderWindow_getSystemHandle($this->cdata);
    }
}