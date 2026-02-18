<?php

namespace iggyvolz\SFML\Window;

use Spem;

final class Vulkan
{
    private function __construct()
    {
    }

    #[Spem("libphpsfml.so", "vulkan_isAvailable")]
    public static function isAvailable(bool $requireGraphics = true): bool {}

    /**
     * @return list<string>
     */
    #[Spem("libphpsfml.so", "vulkan_getGraphicsRequiredInstanceExtensions")]
    public static function getGraphicsRequiredInstanceExtensions(): array {}

}