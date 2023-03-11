<?php

namespace iggyvolz\SFML\System\Vector;

use FFI\CData;
use iggyvolz\SFML\Graphics\GraphicsLib;
use iggyvolz\SFML\System\SystemLib;

/**
 * 3x3 matrix
 * @see Graphics/Glsl.h
 */
readonly class Mat3
{
    public function __construct(
        // sfGlslMat3
        /**
         * @internal
         */
        public CData $cdata
    )
    {
    }
    public static function create(
        GraphicsLib $graphicsLib,
        float $a00, float $a01, float $a02,
        float $a10, float $a11, float $a12,
        float $a20, float $a21, float $a22,
    ): self
    {
        $vector = $graphicsLib->ffi->new("sfGlslMat3");
        $vector->array[0] = $a00;
        $vector->array[1] = $a01;
        $vector->array[2] = $a02;
        $vector->array[3] = $a10;
        $vector->array[4] = $a11;
        $vector->array[5] = $a12;
        $vector->array[6] = $a20;
        $vector->array[7] = $a21;
        $vector->array[8] = $a22;
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
    public function get10(): float
    {
        return $this->cdata[3];
    }

    public function set10(float $a10): float
    {
        return $this->cdata[3];
    }
    public function get11(): float
    {
        return $this->cdata[4];
    }

    public function set11(float $a11): float
    {
        return $this->cdata[4];
    }
    public function get12(): float
    {
        return $this->cdata[5];
    }

    public function set12(float $a12): float
    {
        return $this->cdata[5];
    }
    public function get20(): float
    {
        return $this->cdata[6];
    }

    public function set20(float $a20): float
    {
        return $this->cdata[6];
    }
    public function get21(): float
    {
        return $this->cdata[7];
    }

    public function set21(float $a21): float
    {
        return $this->cdata[7];
    }
    public function get22(): float
    {
        return $this->cdata[8];
    }

    public function set22(float $a22): float
    {
        return $this->cdata[8];
    }

}