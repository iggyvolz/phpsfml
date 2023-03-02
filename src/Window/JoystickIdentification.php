<?php

namespace iggyvolz\SFML\Window;

use FFI\CData;
use iggyvolz\SFML\System\Vector\Vector2U;
use iggyvolz\SFML\Utils\PixelArray;

class JoystickIdentification
{
    public string $name;
    public int $vendorId;
    public int $productid;
    public function __construct(
        // sfJoystickIdentification
        CData $cdata
    )
    {
        $this->name = $cdata->name;
        $this->vendorId = $cdata->vendorId;
        $this->productid = $cdata->productId;
    }

}