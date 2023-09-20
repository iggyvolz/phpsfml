<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use iggyvolz\SFML\Graphics\Vector\Mat3;
use iggyvolz\SFML\Graphics\Vector\Mat4;
use iggyvolz\SFML\Graphics\Vector\Vector2B;
use iggyvolz\SFML\Graphics\Vector\Vector3B;
use iggyvolz\SFML\Graphics\Vector\Vector3I;
use iggyvolz\SFML\Graphics\Vector\Vector4B;
use iggyvolz\SFML\Graphics\Vector\Vector4F;
use iggyvolz\SFML\Graphics\Vector\Vector4I;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\InputStream;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\System\Vector\Vector2I;
use iggyvolz\SFML\System\Vector\Vector3F;
use iggyvolz\SFML\Utils\CType;

#[CType("sfShader*")]
class Shader extends GraphicsObject
{
    public static function createFromFile(Sfml $sfml, string $filename): ?self
    {
        return new self($sfml, $sfml->graphics->ffi->sfShader_createFromFile($filename));
    }

    public static function createFromMemory(Sfml $sfml, string $data): ?self
    {
        $len = strlen($data);
        $dataPtr = $sfml->graphics->ffi->new("char[$len]");
        FFI::memcpy($dataPtr, $data, $len);
        return new self($sfml, $sfml->graphics->ffi->sfShader_createFromMemory($sfml->graphics->ffi->cast("void*", FFI::addr($dataPtr)), $len));
    }

    public static function createFromStream(Sfml $sfml, InputStream $stream): ?self
    {
        return new self($sfml, $sfml->graphics->ffi->sfShader_createFromStream($stream->asGraphics()));
    }

    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfShader_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfShader_destroy($this->cdata);
    }

    public function setUniform(string $name, float|Mat3|Mat4|Vector2F|Vector3F|Vector4F|int|Vector2I|Vector3I|Vector4I|bool|Vector2B|Vector3B|Vector4B|Texture|CurrentTexture $x): void
    {
        if (is_float($x)) {
            $this->sfml->graphics->ffi->sfShader_setFloatUniform($this->cdata, $name, $x);
        } elseif ($x instanceof Vector2F) {
            $this->sfml->graphics->ffi->sfShader_setVec2Uniform($this->cdata, $name, $x->asGraphics());
        } elseif ($x instanceof Vector3F) {
            $this->sfml->graphics->ffi->sfShader_setVec3Uniform($this->cdata, $name, $x->asGraphics());
        } elseif ($x instanceof Vector4F) {
            $this->sfml->graphics->ffi->sfShader_setVec4Uniform($this->cdata, $name, $x->asGraphics());
        } elseif (is_int($x)) {
            $this->sfml->graphics->ffi->sfShader_setIntUniform($this->cdata, $name, $x);
        } elseif ($x instanceof Vector2I) {
            $this->sfml->graphics->ffi->sfShader_setIvec2Uniform($this->cdata, $name, $x->asGraphics());
        } elseif ($x instanceof Vector3I) {
            $this->sfml->graphics->ffi->sfShader_setIvec3Uniform($this->cdata, $name, $x->asGraphics());
        } elseif ($x instanceof Vector4I) {
            $this->sfml->graphics->ffi->sfShader_setIvec4Uniform($this->cdata, $name, $x->asGraphics());
        } elseif (is_bool($x)) {
            $this->sfml->graphics->ffi->sfShader_setBoolUniform($this->cdata, $name, $x);
        } elseif ($x instanceof Vector2B) {
            $this->sfml->graphics->ffi->sfShader_setBvec2Uniform($this->cdata, $name, $x->asGraphics());
        } elseif ($x instanceof Vector3B) {
            $this->sfml->graphics->ffi->sfShader_setBvec3Uniform($this->cdata, $name, $x->asGraphics());
        } elseif ($x instanceof Vector4B) {
            $this->sfml->graphics->ffi->sfShader_setBvec4Uniform($this->cdata, $name, $x->asGraphics());
        } elseif ($x instanceof Mat3) {
            $this->sfml->graphics->ffi->sfShader_setMat3Uniform($this->cdata, $name, $x->asGraphics());
        } elseif ($x instanceof Mat4) {
            $this->sfml->graphics->ffi->sfShader_setMat4Uniform($this->cdata, $name, $x->asGraphics());
        } elseif ($x instanceof Texture) {
            $this->sfml->graphics->ffi->sfShader_setTextureUniform($this->cdata, $name, $x->asGraphics());
        } elseif ($x instanceof CurrentTexture) {
            $this->sfml->graphics->ffi->sfShader_setCurrentTextureUniform($this->cdata, $name);
        }
    }

    public function getNativeHandle(): int
    {
        return $this->sfml->graphics->ffi->sfShader_getNativeHandle($this->cdata);
    }

    public function bind(): void
    {
        $this->sfml->graphics->ffi->sfShader_bind($this->cdata);
    }

    public static function unbind(Sfml $sfml): void
    {
        $sfml->graphics->ffi->sfShader_bind(null);
    }

    public function isAvailable(): bool
    {
        return $this->sfml->graphics->ffi->sfShader_isAvailable() === 1;
    }

    public function isGeometryAvailable(): bool
    {
        return $this->sfml->graphics->ffi->sfShader_isGeometryAvailable() === 1;
    }

}