<?php

namespace iggyvolz\SFML\Window;
use FFI;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Vector\Vector2I;
use iggyvolz\SFML\System\Vector\Vector3F;
use iggyvolz\SFML\Utils\Lib;
use iggyvolz\SFML\Utils\UTF32;

readonly class WindowLib extends Lib
{
    public function __construct(Sfml $sfml, string $libPath)
    {
        parent::__construct($sfml, __DIR__ . "/Window.h", $libPath);
    }

    /**
     * Get the content of the clipboard as string data (returns a Unicode string)
     * This function returns the content of the clipboard
     * as a string. If the clipboard does not contain string
     * it returns an empty string.
     * @return string Clipboard contents as UTF-32
     */
    private function getClipboardUtf32(): string
    {
        $str = $this->ffi->sfClipboard_getUnicodeString();
        $length = 0;
        while($str[$length] !== 0) {
            $length++;
        }

        return FFI::string(FFI::cast("char*", $str), ($length) * 4);
    }


    /**
     * Get the content of the clipboard as string data
     * This function returns the content of the clipboard
     * as a string. If the clipboard does not contain string
     * it returns an empty string.
     * @param string $encoding Desired encoding to return the string in
     * @return string Clipboard contents in the desired encoding
     */
    public function getClipboard(string $encoding = "UTF-8"): string
    {
        return (new UTF32($this->sfml, $this->ffi->sfClipboard_getUnicodeString()))->toString($encoding);
    }


    /**
     * Set the content of the clipboard
     *
     * May not work due to OS restrictions unless a window is focused
     * @param string $text String containing the data to be sent to the clipboard
     * @param string $encoding Encoding of the string
     * @return void
     */
    public function setClipboard(string $text, string $encoding = "UTF-8"): void
    {
        $this->ffi->sfClipboard_setUnicodeString(UTF32::fromString($this->sfml, $text, $encoding)->asWindow());
    }

    /**
     * Check if a touch event is currently down
     * @param int $finger Finger index
     * @return bool True if a finger is currently touching the screen, false otherwise
     */
    public function isTouchDown(int $finger): bool
    {
        return $this->ffi->sfTouch_isDown($finger) === 1;
    }

    /**
     * Get the current position of a touch in window coordinates
     *
     * This function returns the current touch position
     * relative to the given window, or desktop if NULL is passed.
     * @param int $finger Finger index
     * @param StandardWindow|null $relativeTo Reference window
     * @return Vector2I Current position of a finger, or undefined if it's not down
     */
    public function getTouchPosition(int $finger, ?StandardWindow $relativeTo = null): Vector2I
    {
        return new Vector2I($this->sfml, $this->ffi->sfTouch_getPosition($finger, $relativeTo?->asWindow()), true);
    }

    /**
     * Check if a mouse button is pressed
     *
     * @param MouseButton $button Button to check
     * @return bool True if the button is pressed, false otherwise
     */
    public function isMouseButtonPressed(MouseButton $button): bool
    {
        return $this->ffi->sfMouse_isButtonPressed($button->value) === 1;
    }

    /**
     * Get the current position of the mouse
     *
     * This function returns the current position of the mouse
     * cursor relative to the given window, or desktop if NULL is passed.
     * @param StandardWindow|null $relativeTo Reference window
     * @return Vector2I Position of the mouse cursor, relative to the given window
     */
    public function getMousePosition(?StandardWindow $relativeTo = null): Vector2I
    {
        return $this->ffi->sfMouse_getPosition($relativeTo?->asWindow());
    }

    /**
     * Set the current position of the mouse
     *
     * This function sets the current position of the mouse
     * cursor relative to the given window, or desktop if NULL is passed.
     * @param Vector2I $position New position of the mouse
     * @param StandardWindow|null $relativeTo Reference window
     */
    public function setMousePosition(Vector2I $position, ?StandardWindow $relativeTo = null): void
    {
        $this->ffi->sfMouse_setPosition($position->asWindow(), $relativeTo?->asWindow());
    }

    /**
     * Check if a joystick is connected
     *
     * @param int $joystick Index of the joystick to check
     * @return bool True if the joystick is connected, false otherwise
     */
    public function isJoystickConnected(int $joystick): bool
    {
        return $this->ffi->sfJoystick_isConnected($joystick) === 1;
    }

    /**
     * Return the number of buttons supported by a joystick
     *
     * If the joystick is not connected, this function returns 0.
     * @param int $joystick Index of the joystick
     * @return int Number of buttons supported by the joystick
     */
    public function getJoystickButtonCount(int $joystick): int
    {
        return $this->ffi->sfJoystick_getButtonCount($joystick);
    }

    /**
     * Check if a joystick supports a given axis
     *
     * If the joystick is not connected, this function returns false.
     * @param int $joystick Index of the joystick
     * @param JoystickAxis $axis Axis to check
     * @return bool True if the joystick supports the axis, false otherwise
     */
    public function joystickHasAxis(int $joystick, JoystickAxis $axis): bool
    {
        return $this->ffi->sfJoystick_hasAxis($joystick, $axis->value) === 1;
    }

    /**
     * Check if a joystick button is pressed
     *
     * If the joystick is not connected, this function returns false.
     * @param int $joystick Index of the joystick
     * @param int $button Button to check
     * @return bool True if the button is pressed, false otherwise
     */
    public function isJoystickButtonPressed(int $joystick, int $button): bool
    {
        return $this->ffi->sfJoystick_isButtonPressed($joystick, $button) === 1;
    }

    /**
     * Get the current position of a joystick axis
     *
     * If the joystick is not connected, this function returns 0.
     * @param int $joystick Index of the joystick
     * @param JoystickAxis $axis Axis to check
     * @return float Current position of the axis, in range [-100 .. 100]
     */
    public function getJoystickAxisPosition(int $joystick, JoystickAxis $axis): float
    {
        return $this->ffi->sfJoystick_getAxisPosition($joystick, $axis->value);
    }

    /**
     * Get the joystick information
     *
     * The result of this function will only remain valid until
     * the next time the function is called.
     * @param int $joystick Index of the joystick
     * @return JoystickIdentification Structure containing joystick information.
     */
    public function getJoystickIdentification(int $joystick): JoystickIdentification
    {
        return new JoystickIdentification($this->sfml, $this->ffi->sfJoystick_getIdentification($joystick));
    }

    /**
     * Update the states of all joysticks
     *
     * This function is used internally by SFML, so you normally
     * don't have to call it explicitely. However, you may need to
     * call it if you have no window yet (or no window at all):
     * in this case the joysticks states are not updated automatically.
     */
    public function updateJoystick(): void
    {
        $this->ffi->sfJoystick_update();
    }

    /**
     * Check if a key is pressed
     * @param KeyCode $key Key to check
     * @return bool True if the key is pressed, false otherwise
     */
    public function isKeyPressed(KeyCode $key): bool
    {
        return $this->ffi->sfKeyboard_isKeyPressed($key->value) === 1;
    }

    /**
     * Show or hide the virtual keyboard.
     * 
     * Warning: the virtual keyboard is not supported on all systems.
     * It will typically be implemented on mobile OSes (Android, iOS)
     * but not on desktop OSes (Windows, Linux, ...).
     *
     * If the virtual keyboard is not available, this function does nothing.
     * @param bool $visible True to show, false to hide
     */
    public function setVirtualKeyboardVisible(bool $visible): void
    {
        $this->ffi->sfKeyboard_setVirtualKeyboardVisible($visible);
    }

    /**
     * Check if a sensor is available on the underlying platform
     * @param SensorType $sensor Sensor to check
     * @return bool True if the sensor is available, false otherwise
     */
    public function isSensorAvailable(SensorType $sensor): bool
    {
        return $this->ffi->sfSensor_isAvailable($sensor->value) === 1;
    }

    /**
     * Enable or disable a sensor
     *
     * All sensors are disabled by default, to avoid consuming too
     * much battery power. Once a sensor is enabled, it starts
     * sending events of the corresponding type.
     *
     * This function does nothing if the sensor is unavailable.
     * @param SensorType $sensor Sensor to enable
     * @param bool $enabled True to enable, false to disable
     * @return void
     */
    public function setSensorEnabled(SensorType $sensor, bool $enabled): void
    {
        $this->ffi->sfSensor_setEnabled($sensor->value, $enabled?1:0);
    }

    /**
     * Get the current sensor value
     * @param SensorType $sensor Sensor to read
     * @return Vector3F The current sensor value
     */
    public function getSensorValue(SensorType $sensor): Vector3F
    {
        return new Vector3F($this->sfml, $this->ffi->sfSensor_getValue($sensor->value), true);
    }
}
