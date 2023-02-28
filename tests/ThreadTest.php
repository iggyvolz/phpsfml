<?php

use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Time;
use Tester\Assert;
use Tester\Environment;

require_once __DIR__ . "/../vendor/autoload.php";
Environment::setup();
Environment::skip("Skip threading test - it just segfaults instantly");
$systemLib = new SystemLib(__DIR__ . "/../CSFML/lib/libcsfml-system.so");
$thread = \iggyvolz\SFML\System\Thread::create($systemLib, function (){
    var_dump("HI");
    sleep(2);
});
$thread->launch();
$thread->wait();
sleep(2);