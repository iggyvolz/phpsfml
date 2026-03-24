<?php
namespace iggyvolz\SFML;

use iggyvolz\SFML\System\Time;

#[\Spem("time_sleep")]
function sleep(Time $time): void {

}
#[\Spem("getClipboard")]
function getClipboard(): string {}
#[\Spem("setClipboard")]
function setClipboard(string $string): void {}