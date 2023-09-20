<?php

namespace iggyvolz\SFML\Graphics\Vector;

use iggyvolz\SFML\Graphics\GraphicsObject;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

/**
 * 4x4 matrix
 * @see Graphics/Glsl.h
 */
#[CType("sfGlslMat4")]
class Mat4 extends GraphicsObject
{
    public static function create(
        Sfml $sfml,
        float $a00, float $a01, float $a02, float $a03,
        float $a10, float $a11, float $a12, float $a13,
        float $a20, float $a21, float $a22, float $a23,
        float $a30, float $a31, float $a32, float $a33,
    ): self
    {
        $self = static::newObject($sfml);
        $self->set00($a00);
        $self->set01($a01);
        $self->set02($a02);
        $self->set03($a03);
        $self->set10($a10);
        $self->set11($a11);
        $self->set12($a12);
        $self->set13($a13);
        $self->set20($a20);
        $self->set21($a21);
        $self->set22($a22);
        $self->set23($a23);
        $self->set30($a30);
        $self->set31($a31);
        $self->set32($a32);
        $self->set33($a33);
        return $self;
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