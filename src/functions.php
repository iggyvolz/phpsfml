<?php
namespace iggyvolz\SFML;

use iggyvolz\SFML\System\Time;

#[\Spem("libphpsfml.so", "time_sleep")]
function sleep(Time $time): void {

}
#[\Spem("libphpsfml.so", "getClipboard")]
function getClipboard(): string {}
#[\Spem("libphpsfml.so", "setClipboard")]
function setClipboard(string $string): void {}