<?php

namespace iggyvolz\SFML\Window;

use Spem;

final class Context
{
    #[Spem("context_construct")]
    public function __construct(
    )
    {
    }

    #[Spem("context_setActive")]
    public function setActive(bool $active): bool {}
    public ContextSettings $settings { #[Spem("context_getSettings")] get {}}
    #[Spem("context_isExtensionAvailable")]
    public static function isExtensionAvailable(string $name): bool {}
    #[Spem("context_getActiveContext")]
    public static function getActiveContext(): self {}
    #[Spem("context_getActiveContextId")]
    public static function getActiveContextId(): int {}
    #[Spem("context_destruct")]
    public function __destruct()
    {
    }

}