--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$eitherFooBarBaz = v::onlyOneOf(v::key('foo'), v::key('bar'), v::key('baz'));
var_dump(
    v::onlyOneOf(v::positive(), v::negative())->validate(10),
    v::onlyOneOf(v::positive(), v::positive())->validate(10),
    v::onlyOneOf(v::negative(), v::negative())->validate(10),
    $eitherFooBarBaz->validate(['foo' => 'yes', 'bar' => 'no', 'baz' => 'maybe']),
    $eitherFooBarBaz->validate(['foo' => 'yes', 'bar' => 'no']),
    $eitherFooBarBaz->validate(['baz' => 'maybe']),
    $eitherFooBarBaz->validate([])
);
--EXPECTF--
bool(true)
bool(false)
bool(false)
bool(false)
bool(false)
bool(true)
bool(false)
