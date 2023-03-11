<?php

namespace iggyvolz\SFML\Graphics;
use FFI;
use FFI\CData;
use iggyvolz\SFML\System\InputStream;
use iggyvolz\SFML\System\Vector\Mat3;
use iggyvolz\SFML\System\Vector\Mat4;
use iggyvolz\SFML\System\Vector\Vector2B;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\System\Vector\Vector2I;
use iggyvolz\SFML\System\Vector\Vector3B;
use iggyvolz\SFML\System\Vector\Vector3F;
use iggyvolz\SFML\System\Vector\Vector3I;
use iggyvolz\SFML\System\Vector\Vector4B;
use iggyvolz\SFML\System\Vector\Vector4F;
use iggyvolz\SFML\System\Vector\Vector4I;

class Shader
{
    public function __construct(
        public readonly GraphicsLib $graphicsLib,
        // sfShader*
        /**
         * @internal
         */
        public CData $cdata,
    )
    {
    }

    public static function createFromFile(GraphicsLib $graphicsLib, string $filename): ?self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfShader_createFromFile($filename));
    }

    public static function createFromMemory(GraphicsLib $graphicsLib, string $data): ?self
    {
        $len = strlen($data);
        $dataPtr = FFI::new("char[$len]");
        FFI::memcpy($dataPtr, $data, $len);
        return new self($graphicsLib, $graphicsLib->ffi->sfShader_createFromMemory(FFI::cast("void*", FFI::addr($dataPtr)), $len));
    }

    public static function createFromStream(GraphicsLib $graphicsLib, InputStream $stream): ?self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfShader_createFromStream($stream->cdata));
    }

    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfShader_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfShader_destroy($this->cdata);
    }

    public function setUniform(string $name, float|Mat3|Mat4|Vector2F|Vector3F|Vector4F|int|Vector2I|Vector3I|Vector4I|bool|Vector2B|Vector3B|Vector4B|Texture|CurrentTexture $x): void
    {
        if(is_float($x)) {
            $this->graphicsLib->ffi->sfShader_setFloatUniform($this->cdata, $name, $x);
        } elseif($x instanceof Vector2F) {
            $this->graphicsLib->ffi->sfShader_setVec2Uniform($this->cdata, $name, $x->cdata);
        } elseif($x instanceof Vector3F) {
            $this->graphicsLib->ffi->sfShader_setVec3Uniform($this->cdata, $name, $x->cdata);
        } elseif($x instanceof Vector4F) {
            $this->graphicsLib->ffi->sfShader_setVec4Uniform($this->cdata, $name, $x->cdata);
        } elseif(is_int($x)) {
            $this->graphicsLib->ffi->sfShader_setIntUniform($this->cdata, $name, $x);
        } elseif($x instanceof Vector2I) {
            $this->graphicsLib->ffi->sfShader_setIvec2Uniform($this->cdata, $name, $x->cdata);
        } elseif($x instanceof Vector3I) {
            $this->graphicsLib->ffi->sfShader_setIvec3Uniform($this->cdata, $name, $x->cdata);
        } elseif($x instanceof Vector4I) {
            $this->graphicsLib->ffi->sfShader_setIvec4Uniform($this->cdata, $name, $x->cdata);
        } elseif(is_bool($x)) {
            $this->graphicsLib->ffi->sfShader_setBoolUniform($this->cdata, $name, $x);
        } elseif($x instanceof Vector2B) {
            $this->graphicsLib->ffi->sfShader_setBvec2Uniform($this->cdata, $name, $x->cdata);
        } elseif($x instanceof Vector3B) {
            $this->graphicsLib->ffi->sfShader_setBvec3Uniform($this->cdata, $name, $x->cdata);
        } elseif($x instanceof Vector4B) {
            $this->graphicsLib->ffi->sfShader_setBvec4Uniform($this->cdata, $name, $x->cdata);
        } elseif($x instanceof Mat3) {
            $this->graphicsLib->ffi->sfShader_setMat3Uniform($this->cdata, $name, $x->cdata);
        } elseif($x instanceof Mat4) {
            $this->graphicsLib->ffi->sfShader_setMat4Uniform($this->cdata, $name, $x->cdata);
        } elseif($x instanceof Texture) {
            $this->graphicsLib->ffi->sfShader_setTextureUniform($this->cdata, $name, $x->cdata);
        } elseif($x instanceof CurrentTexture) {
            $this->graphicsLib->ffi->sfShader_setCurrentTextureUniform($this->cdata, $name);
        }
    }

    public function getNativeHandle(): int
    {
        return $this->graphicsLib->ffi->sfShader_getNativeHandle($this->cdata);
    }

    public function bind(): void
    {
        $this->graphicsLib->ffi->sfShader_bind($this->cdata);
    }
    public static function unbind(GraphicsLib $graphicsLib): void
    {
        $graphicsLib->ffi->sfShader_bind(null);
    }
    public function isAvailable(): bool
    {
        return $this->graphicsLib->ffi->sfShader_isAvailable() === 1;
    }
    public function isGeometryAvailable(): bool
    {
        return $this->graphicsLib->ffi->sfShader_isGeometryAvailable() === 1;
    }

}