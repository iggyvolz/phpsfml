<?php

namespace iggyvolz\SFML\Graphics;

use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\System\Vector\Vector2F;
use iggyvolz\SFML\Utils\CType;
use LogicException;
#[CType("sfSprite*")]
class Sprite extends GraphicsObject implements Drawable, Transformable
{
    public static function create(
        Sfml $sfml,
    ): ?self
    {
        $cdata = $sfml->graphics->ffi->sfSprite_create();
        return is_null($cdata) ? null : new self($sfml, $cdata);
    }

    public function __clone(): void
    {
        $this->cdata = $this->sfml->graphics->ffi->sfSprite_copy($this->cdata);
    }

    public function __destruct()
    {
        $this->sfml->graphics->ffi->sfSprite_destroy($this->cdata);
    }


    public function draw(RenderTarget $target, ?RenderStates $renderStates = null): void
    {
        if($target instanceof RenderTexture) {
            $this->sfml->graphics->ffi->sfRenderTexture_drawSprite($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } elseif($target instanceof RenderWindow) {
            $this->sfml->graphics->ffi->sfRenderWindow_drawSprite($target->asGraphics(), $this->cdata, $renderStates?->asGraphics());
        } else {
            throw new LogicException();
        }
    }

    public function setPosition(Vector2F $position): void
    {
        $this->sfml->graphics->ffi->sfSprite_setPosition($this->cdata, $position->asGraphics());
    }

    public function setRotation(float $angle): void
    {
        $this->sfml->graphics->ffi->sfSprite_setRotation($this->cdata, $angle);
    }

    public function setScale(Vector2F $scale): void
    {
        $this->sfml->graphics->ffi->sfSprite_setScale($this->cdata, $scale->asGraphics());
    }

    public function setOrigin(Vector2F $origin): void
    {
        $this->sfml->graphics->ffi->sfSprite_setOrigin($this->cdata, $origin->asGraphics());
    }

    public function getPosition(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfSprite_getPosition($this->cdata), true);
    }

    public function getRotation(): float
    {
        return $this->sfml->graphics->ffi->sfSprite_getRotation($this->cdata);
    }

    public function getScale(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfSprite_getScale($this->cdata), true);
    }

    public function getOrigin(): Vector2F
    {
        return new Vector2F($this->sfml, $this->sfml->graphics->ffi->sfSprite_getOrigin($this->cdata), true);
    }

    public function move(Vector2F $offset): void
    {
        $this->sfml->graphics->ffi->sfSprite_move($this->cdata, $offset->asGraphics());
    }

    public function rotate(float $offset): void
    {
        $this->sfml->graphics->ffi->sfSprite_rotate($this->cdata, $offset);
    }

    public function scale(Vector2F $offset): void
    {
        $this->sfml->graphics->ffi->sfSprite_scale($this->cdata, $offset->asGraphics());
    }

    public function getTransform(): Transform
    {
        return new Transform($this->sfml, $this->sfml->graphics->ffi->sfSprite_getTransform($this->cdata));
    }

    public function getInverseTransform(): Transform
    {
        return new Transform($this->sfml, $this->sfml->graphics->ffi->sfSprite_getInverseTransform($this->cdata));
    }

    public function setTexture(Texture $texture, bool $resetRect): void
    {
        $this->sfml->graphics->ffi->sfSprite_setTexture($this->cdata, $texture->asGraphics(), $resetRect);
    }
    public function setTextureRect(IntRect $rectangle): void
    {
        $this->sfml->graphics->ffi->sfSprite_setTextureRect($this->cdata, $rectangle->asGraphics());
    }
    public function setColor(Color $color): void
    {
        $this->sfml->graphics->ffi->sfSprite_setColor($this->cdata, $color->asGraphics());
    }

    public function getTexture(): Texture
    {
        return new Texture($this->sfml, $this->sfml->graphics->ffi->sfSprite_getTexture($this->cdata));
    }
    public function getTextureRect(): IntRect
    {
        return new IntRect($this->sfml, $this->sfml->graphics->ffi->sfSprite_getTextureRect($this->cdata));
    }
    public function getColor(): Color
    {
        return new Color($this->sfml, $this->sfml->graphics->ffi->sfSprite_getColor($this->cdata));
    }

    public function getLocalBounds(): FloatRect
    {
        return new FloatRect($this->sfml, $this->sfml->graphics->ffi->sfSprite_getLocalBounds($this->cdata));
    }

    public function getGlobalBounds(): FloatRect
    {
        return new FloatRect($this->sfml, $this->sfml->graphics->ffi->sfSprite_getGlobalBounds($this->cdata));
    }
}