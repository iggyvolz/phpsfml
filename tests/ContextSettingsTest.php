<?php

use iggyvolz\SFML\System\Angle;
use iggyvolz\SFML\Window\ContextAttribute;
use iggyvolz\SFML\Window\ContextSettings;
use Tester\Assert;

require_once __DIR__ . "/bootstrap.php";
$settings = new ContextSettings();
$settings->attributeFlags = [ContextAttribute::Debug];
Assert::same([ContextAttribute::Debug], $settings->attributeFlags);