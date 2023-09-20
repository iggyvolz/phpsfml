<?php

namespace iggyvolz\SFML\Window;

use iggyvolz\SFML\Utils\CType;

#[CType("sfJoystickIdentification")]
class JoystickIdentification extends WindowObject
{
    public function getName(): string
    {
        return $this->cdata->name;
    }
    public function setName(string $name): void
    {
        $this->cdata->name = $name;
    }
    public function getVendorId(): int
    {
        return $this->cdata->vendorId;
    }
    public function setVendorId(int $vendorId): void
    {
        $this->cdata->vendorId = $vendorId;
    }
    public function getProductId(): int
    {
        return $this->cdata->productId;
    }
    public function setProductId(int $productId): void
    {
        $this->cdata->productId = $productId;
    }

}