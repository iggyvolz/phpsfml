<?php

namespace iggyvolz\SFML\Graphics\Vector;

use iggyvolz\SFML\Graphics\GraphicsObject;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Utils\CType;

/**
 * 3x3 matrix
 * @see Graphics/Glsl.h
 */
#[CType("sfGlslMat3")]
class Mat3 extends GraphicsObject
{
    public static function create(
        Sfml $sfml,
        float $a00, float $a01, float $a02,
        float $a10, float $a11, float $a12,
        float $a20, float $a21, float $a22,
    ): self
    {
        $self = static::newObject($sfml);
        $self->set00($a00);
        $self->set01($a01);
        $self->set02($a02);
        $self->set10($a10);
        $self->set11($a11);
        $self->set12($a12);
        $self->set20($a20);
        $self->set21($a21);
        $self->set22($a22);
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