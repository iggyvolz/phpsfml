<?php

use iggyvolz\SFML\Utils\SfString;
use Tester\Assert;

require_once __DIR__ . "/bootstrap.php";
$str = new SfString("foo bar");
Assert::same("foo bar", $str->data);
Assert::same("foo bar", "$str");
Assert::same("foo bar", $str->toString());
$str->append(new SfString(" baz"));
Assert::same("foo bar baz", $str->toString());
Assert::same(11, $str->size);
Assert::false($str->isEmpty);
$str->clear();
Assert::true($str->isEmpty);
Assert::same(0, $str->size);
Assert::same("", $str->toString());

$str->append(new SfString("foo bar"));
$str->erase(1);
Assert::same("fo bar", $str->toString());
$str->erase(1, 2);
Assert::same("fbar", $str->toString());

$str->insert(0, new SfString("baz"));
Assert::same("bazfbar", $str->toString());

Assert::null($str->find(new SfString("abc")));
Assert::equal(0, $str->find(new SfString("baz")));
Assert::equal(1, $str->find(new SfString("azfb")));

Assert::null($str->find(new SfString("baz"), 1));
