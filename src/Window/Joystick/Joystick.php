<?php

namespace iggyvolz\SFML\Window\Joystick;

use OutOfRangeException;
use Spem;

class Joystick
{
    const int COUNT = 8;
    const int BUTTON_COUNT = 32;
    const int AXIS_COUNT = 8;
    private static array $joysticks = [];
    public static function get(int $index): self
    {
        if($index < 0 || $index >= self::COUNT) {
            throw new OutOfRangeException("Index $index is out of range");
        }
        return self::$joysticks[$index] ?? new self($index);
    }
    /** @return list<self> */
    public static function getAll(): array
    {
        return array_map(fn(int $index) => self::get($index), range(0, self::COUNT - 1));
    }
    /** @return list<self> */
    public static function getConnected(): array
    {
        return array_filter(self::getAll(), fn(self $joystick) => $joystick->isConnected);
    }
    private function __construct(public readonly int $index) {

    }
    public bool $isConnected { #[Spem("libphpsfml.so", "joystick_isConnected")] get {}}
    public int $buttonCount { #[Spem("libphpsfml.so", "joystick_getButtonCount")] get {}}
    #[Spem("libphpsfml.so", "joystick_hasAxis")]
    public function hasAxis(Axis $axis): bool { }
    #[Spem("libphpsfml.so", "joystick_isButtonPressed")]
    public function isButtonPressed(int $button): bool {}
    #[Spem("libphpsfml.so", "joystick_getAxisPosition")]
    public function getAxisPosition(Axis $axis): float {}
    public string $name { #[Spem("libphpsfml.so", "joystick_getName")] get {}}
    public int $vendorId { #[Spem("libphpsfml.so", "joystick_getVendorId")] get {}}
    public int $productId { #[Spem("libphpsfml.so", "joystick_getProductId")] get {}}

    #[Spem("libphpsfml.so", "joystick_update")]
    public static function update(): void
    {

    }
}