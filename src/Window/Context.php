<?php

namespace iggyvolz\SFML\Window;

use Spem;

final class Context
{
    #[Spem("libphpsfml.so", "context_construct")]
    public function __construct(
    )
    {
    }

    #[Spem("libphpsfml.so", "context_setActive")]
    public function setActive(bool $active): bool {}
    public ContextSettings $settings { #[Spem("libphpsfml.so", "context_getSettings")] get {}}
    #[Spem("libphpsfml.so", "context_isExtensionAvailable")]
    public static function isExtensionAvailable(string $name): bool {}
    #[Spem("libphpsfml.so", "context_getActiveContext")]
    public static function getActiveContext(): self {}
    #[Spem("libphpsfml.so", "context_getActiveContextId")]
    public static function getActiveContextId(): int {}
    #[Spem("libphpsfml.so", "context_destruct")]
    public function __destruct()
    {
    }

}