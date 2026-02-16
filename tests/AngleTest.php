<?php

use iggyvolz\SFML\System\Angle;
use Tester\Assert;

require_once __DIR__ . "/bootstrap.php";
$angle = Angle::fromDegrees(90.0);
assert_close(M_PI_2, $angle->radians);
Assert::same(90.0, $angle->degrees);

$angle2 = Angle::fromRadians(10);
Assert::same(10.0, $angle2->radians);
assert_close(10 * 180 / M_PI, $angle2->degrees, 0.01);