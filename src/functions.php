<?php
namespace iggyvolz\SFML;

use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\Utils\SfString;

#[\Spem("libphpsfml.so", "time_sleep")]
function sleep(Time $time): void {

}
#[\Spem("libphpsfml.so", "getClipboard")]
function getClipboard(): SfString {}
#[\Spem("libphpsfml.so", "setClipboard")]
function setClipboard(SfString $string): void {}