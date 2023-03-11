<?php

namespace iggyvolz\SFML\Graphics;

use FFI;
use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;

class Transform
{

    public function __construct(
        private readonly GraphicsLib $graphicsLib,
        // sfTransform
        public CData                 $cdata
    )
    {
    }

    /**
     * @return self Identity transform (does nothing)
     */
    public static function getIdentity(GraphicsLib $graphicsLib): self
    {
        $self = new self($graphicsLib, $graphicsLib->ffi->sfTransform_Identity);
        return clone $self;
    }

    public function __clone(): void
    {
        $old = $this->cdata;
        $this->cdata = $this->graphicsLib->ffi->new("sfTransform");
        FFI::memcpy($this->cdata, $old, FFI::sizeof($old));
    }

    public static function createFromMatrix(
        GraphicsLib $graphicsLib,
        float $a00, float $a01, float $a02,
        float $a10, float $a11, float $a12,
        float $a20, float $a21, float $a22,
    ): self
    {
        return new self($graphicsLib, $graphicsLib->ffi->sfTransform_fromMatrix($a00, $a01, $a02, $a10, $a11, $a12, $a20, $a21, $a22));
    }

    /**
     * Return the 4x4 matrix of a transform
     *
     * This function fills an array of 16 floats with the transform
     * converted as a 4x4 matrix, which is directly compatible with
     * OpenGL functions.
     * @return CData float[16]
     */
    public function getGlMatrix(): CData
    {
        $matrix = $this->graphicsLib->ffi->new("float[16]");
        $this->graphicsLib->ffi->sfTransform_getMatrix(FFI::addr($this->cdata), FFI::addr($matrix));
        return $matrix;
    }

    /**
     * Return the inverse of a transform
     *
     * If the inverse cannot be computed, a new identity transform
     * is returned.
     * @return self The inverse matrix
     */
    public function getInverse(): self
    {
        return new self($this->graphicsLib, $this->graphicsLib->ffi->sfTransform_getInverse(FFI::addr($this->cdata)));
    }

    /**
     * Apply a transform to a 2D point
     * @param Vector2F $point Point to transform
     * @return Vector2F Transformed point
     */
    public function transformPoint(Vector2F $point): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfTransform_transformPoint(FFI::addr($this->cdata), $point->cdata));
    }

    /**
     * Apply a transform to a rectangle
     *
     * Since SFML doesn't provide support for oriented rectangles,
     * the result of this function is always an axis-aligned
     * rectangle. Which means that if the transform contains a
     * rotation, the bounding rectangle of the transformed rectangle
     * is returned.
     * @param FloatRect $rect Rectangle to transform
     * @return FloatRect Transformed rectangle
     */
    public function transformRect(FloatRect $rect): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfTransform_transformRect(FFI::addr($this->cdata), $rect->cdata));
    }

    /**
     * Combine two transforms
     *
     * The result is a transform that is equivalent to applying
     * \a transform followed by \a other. Mathematically, it is
     * equivalent to a matrix multiplication.
     * @param Transform $other Transform to combine to \a transform
     */
    public function combine(Transform $other): void
    {
        $this->graphicsLib->ffi->sfTransform_combine(FFI::addr($this->cdata), FFI::addr($other->cdata));
    }

    /**
     * Combine a transform with a translation
     * @param float $x Offset to apply on X axis
     * @param float $y Offset to apply on Y axis
     */
    public function translate(float $x, float $y): void
    {
        $this->graphicsLib->ffi->sfTransform_translate(FFI::addr($this->cdata), $x, $y);
    }

    /**
     * Combine the current transform with a rotation
     * @param float $angle Rotation angle, in degrees
     */
    public function rotate(float $angle): void
    {
        $this->graphicsLib->ffi->sfTransform_rotate(FFI::addr($this->cdata), $angle);
    }

    /**
     * Combine the current transform with a rotation
     *
     * The center of rotation is provided for convenience as a second
     * argument, so that you can build rotations around arbitrary points
     * more easily (and efficiently) than the usual
     * [translate(-center), rotate(angle), translate(center)].
     * @param float $angle Rotation angle, in degrees
     * @param float $centerX X coordinate of the center of rotation
     * @param float $centerY Y coordinate of the center of rotation
     */
    public function rotateWithCenter(float $angle, float $centerX, float $centerY): void
    {
        $this->graphicsLib->ffi->sfTransform_rotateWithCenter(FFI::addr($this->cdata), $angle, $centerX, $centerY);
    }

    /**
     * Combine the current transform with a scaling
     * @param float $scaleX Scaling factor on the X axis
     * @param float $scaleY Scaling factor on the Y axis
     */
    public function scale(float $scaleX, float $scaleY): void
    {
        $this->graphicsLib->ffi->sfTransform_scale(FFI::addr($this->cdata), $scaleX, $scaleY);
    }

    /**
     * Combine the current transform with a scaling
     *
     * The center of scaling is provided for convenience as a second
     * argument, so that you can build scaling around arbitrary points
     * more easily (and efficiently) than the usual
     * [translate(-center), scale(factors), translate(center)]
     * @param float $scaleX Scaling factor on the X axis
     * @param float $scaleY Scaling factor on the Y axis
     * @param float $centerX X coordinate of the center of scaling
     * @param float $centerY Y coordinate of the center of scaling
     */
    public function scaleWithCenter(float $scaleX, float $scaleY, float $centerX, float $centerY): void
    {
        $this->graphicsLib->ffi->sfTransform_scaleWithCenter(FFI::addr($this->cdata), $scaleX, $scaleY, $centerX, $centerY);
    }

    /**
     * Compare two transforms for equality
     *
     * Performs an element-wise comparison of the elements of the
     * left transform with the elements of the right transform.
     * @return bool true if the transforms are equal, false otherwise
     */
    public function equal(Transform $other): bool
    {
        return $this->graphicsLib->ffi->sfTransform_equal(FFI::addr($this->cdata), FFI::addr($other->cdata)) === 1;
    }
}