<?php

namespace iggyvolz\SFML\Graphics;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2F;
use LogicException;

class Sprite implements Drawable, Transformable
{

    public function __construct(
        private GraphicsLib $graphicsLib,
        // sfSprite*
        /** @internal  */
        private CData $cdata
    )
    {
    }
    public static function create(
        GraphicsLib $graphicsLib,
    ): ?self
    {
        $cdata = $graphicsLib->ffi->sfSprite_create();
        return is_null($cdata) ? null : new self($graphicsLib, $cdata);
    }

    public function __clone(): void
    {
        $this->cdata = $this->graphicsLib->ffi->sfSprite_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->graphicsLib->ffi->sfSprite_destroy($this->cdata);
    }


    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->graphicsLib->ffi->sfRenderTexture_drawSprite($target->cdata, $this->cdata, $renderStates?->cdata);
        } elseif($target instanceof RenderWindow) {
            $this->graphicsLib->ffi->sfRenderWindow_drawSprite($target->cdata, $this->cdata, $renderStates?->cdata);
        } else {
            throw new LogicException();
        }
    }

    public function setPosition(Vector2F $position): void
    {
        $this->graphicsLib->ffi->sfSprite_setPosition($this->cdata, $position->cdata);
    }

    public function setRotation(float $angle): void
    {
        $this->graphicsLib->ffi->sfSprite_setRotation($this->cdata, $angle);
    }

    public function setScale(Vector2F $scale): void
    {
        $this->graphicsLib->ffi->sfSprite_setScale($this->cdata, $scale->cdata);
    }

    public function setOrigin(Vector2F $origin): void
    {
        $this->graphicsLib->ffi->sfSprite_setOrigin($this->cdata, $origin->cdata);
    }

    public function getPosition(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfSprite_getPosition($this->cdata));
    }

    public function getRotation(): float
    {
        return $this->graphicsLib->ffi->sfSprite_getRotation($this->cdata);
    }

    public function getScale(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfSprite_getScale($this->cdata));
    }

    public function getOrigin(): Vector2F
    {
        return new Vector2F($this->graphicsLib->ffi->sfSprite_getOrigin($this->cdata));
    }

    public function move(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfSprite_move($this->cdata, $offset->cdata);
    }

    public function rotate(float $offset): void
    {
        $this->graphicsLib->ffi->sfSprite_rotate($this->cdata, $offset);
    }

    public function scale(Vector2F $offset): void
    {
        $this->graphicsLib->ffi->sfSprite_scale($this->cdata, $offset->cdata);
    }

    public function getTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfSprite_getTransform($this->cdata));
    }

    public function getInverseTransform(): Transform
    {
        return new Transform($this->graphicsLib, $this->graphicsLib->ffi->sfSprite_getInverseTransform($this->cdata));
    }

    public function setTexture(Texture $texture, bool $resetRect): void
    {
        $this->graphicsLib->ffi->sfSprite_setTexture($this->cdata, $texture->cdata, $resetRect);
    }
    public function setTextureRect(IntRect $rectangle): void
    {
        $this->graphicsLib->ffi->sfSprite_setTextureRect($this->cdata, $rectangle->cdata);
    }
    public function setColor(Color $color): void
    {
        $this->graphicsLib->ffi->sfSprite_setColor($this->cdata, $color->cdata);
    }

    public function getTexture(): Texture
    {
        return new Texture($this->graphicsLib, $this->graphicsLib->ffi->sfSprite_getTexture($this->cdata));
    }
    public function getTextureRect(): IntRect
    {
        return new IntRect($this->graphicsLib, $this->graphicsLib->ffi->sfSprite_getTextureRect($this->cdata));
    }
    public function getColor(): Color
    {
        return new Color($this->graphicsLib, $this->graphicsLib->ffi->sfSprite_getColor($this->cdata));
    }

    public function getLocalBounds(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfSprite_getLocalBounds($this->cdata));
    }

    public function getGlobalBounds(): FloatRect
    {
        return new FloatRect($this->graphicsLib, $this->graphicsLib->ffi->sfSprite_getGlobalBounds($this->cdata));
    }
}