<?php

namespace iggyvolz\SFML\System\Vector;

use FFI\CData;
use iggyvolz\SFML\Graphics\GraphicsLib;
use iggyvolz\SFML\System\SystemLib;

/**
 * 4x4 matrix
 * @see Graphics/Glsl.h
 */
readonly class Mat4
{
    public function __construct(
        // sfGlslMat4
        /**
         * @internal
         */
        public CData $cdata
    )
    {
    }
    public static function create(
        GraphicsLib $graphicsLib,
        float $a00, float $a01, float $a02, float $a03,
        float $a10, float $a11, float $a12, float $a13,
        float $a20, float $a21, float $a22, float $a23,
        float $a30, float $a31, float $a32, float $a33,
    ): self
    {
        $vector = $graphicsLib->ffi->new("sfGlslMat4");
        $vector->array[0] = $a00;
        $vector->array[1] = $a01;
        $vector->array[2] = $a02;
        $vector->array[3] = $a03;
        $vector->array[4] = $a10;
        $vector->array[5] = $a11;
        $vector->array[6] = $a12;
        $vector->array[7] = $a13;
        $vector->array[8] = $a20;
        $vector->array[9] = $a21;
        $vector->array[10] = $a22;
        $vector->array[11] = $a23;
        $vector->array[12] = $a30;
        $vector->array[13] = $a31;
        $vector->array[14] = $a32;
        $vector->array[15] = $a33;

        return new self($vector);
    }

    public function get00(): float
    {
        return $this->cdata[0];
    }

    public function set00(float $a00): float
    {
        return $this->cdata[0];
    }
    public function get01(): float
    {
        return $this->cdata[1];
    }

    public function set01(float $a01): float
    {
        return $this->cdata[1];
    }
    public function get02(): float
    {
        return $this->cdata[2];
    }

    public function set02(float $a02): float
    {
        return $this->cdata[2];
    }
    public function get03(): float
    {
        return $this->cdata[3];
    }

    public function set03(float $a03): float
    {
        return $this->cdata[3];
    }
    public function get10(): float
    {
        return $this->cdata[4];
    }

    public function set10(float $a10): float
    {
        return $this->cdata[4];
    }
    public function get11(): float
    {
        return $this->cdata[5];
    }

    public function set11(float $a11): float
    {
        return $this->cdata[5];
    }
    public function get12(): float
    {
        return $this->cdata[6];
    }

    public function set12(float $a12): float
    {
        return $this->cdata[6];
    }
    public function get13(): float
    {
        return $this->cdata[7];
    }

    public function set13(float $a13): float
    {
        return $this->cdata[7];
    }
    public function get20(): float
    {
        return $this->cdata[8];
    }

    public function set20(float $a20): float
    {
        return $this->cdata[8];
    }
    public function get21(): float
    {
        return $this->cdata[9];
    }

    public function set21(float $a21): float
    {
        return $this->cdata[9];
    }
    public function get22(): float
    {
        return $this->cdata[10];
    }

    public function set22(float $a22): float
    {
        return $this->cdata[10];
    }
    public function get23(): float
    {
        return $this->cdata[11];
    }

    public function set23(float $a23): float
    {
        return $this->cdata[11];
    }
    public function get30(): float
    {
        return $this->cdata[12];
    }

    public function set30(float $a30): float
    {
        return $this->cdata[12];
    }
    public function get31(): float
    {
        return $this->cdata[13];
    }

    public function set31(float $a31): float
    {
        return $this->cdata[13];
    }
    public function get32(): float
    {
        return $this->cdata[14];
    }

    public function set32(float $a32): float
    {
        return $this->cdata[14];
    }
    public function get33(): float
    {
        return $this->cdata[15];
    }

    public function set33(float $a33): float
    {
        return $this->cdata[15];
    }

}