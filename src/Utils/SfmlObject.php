<?php

namespace iggyvolz\SFML\Utils;

use FFI\CData;
use iggyvolz\SFML\Sfml;
use Iggyvolz\SimpleAttributeReflection\AttributeReflection;
use ReflectionClass;

abstract class SfmlObject
{
    /**
     * @internal
     * almost readonly: https://wiki.php.net/rfc/readonly_amendments#proposal_2readonly_properties_can_be_reinitialized_during_cloning
     */
    protected CData $cdata;

    public final function __construct(
        public readonly Sfml $sfml,
        CData                $cdata,
        bool                 $external = false,
    )
    {
        $this->cdata = $external ? static::getLib($this->sfml)->ffi->cast(self::getCType(), $cdata) : $cdata;
    }

    /**
     * @var array<string,string> cache for getCType()
     */
    private static array $ctypes = [];

    protected static function getCType(): string
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return self::$ctypes[static::class] ??=
            (AttributeReflection::getAttribute(new ReflectionClass(static::class), CType::class)?->type) ??
            get_parent_class(static::class)::getCType();
    }

    protected abstract static function getLib(Sfml $sfml): Lib;

    /**
     * @internal
     */
    public function asAudio(): CData
    {
        return $this->sfml->audio->ffi->cast(self::getCType(), $this->cdata);
    }

    /**
     * @internal
     */
    public function asGraphics(): CData
    {
        return $this->sfml->graphics->ffi->cast(self::getCType(), $this->cdata);
    }

    /**
     * @internal
     */
    public function asNetwork(): CData
    {
        return $this->sfml->network->ffi->cast(self::getCType(), $this->cdata);
    }

    /**
     * @internal
     */
    public function asSystem(): CData
    {
        return $this->sfml->system->ffi->cast(self::getCType(), $this->cdata);
    }

    /**
     * @internal
     */
    public function asWindow(): CData
    {
        return $this->sfml->window->ffi->cast(self::getCType(), $this->cdata);
    }

    /** @internal */
    protected static function newObject(Sfml $sfml): static
    {
        return new static($sfml, static::getLib($sfml)->ffi->new(static::getCType()));
    }
}