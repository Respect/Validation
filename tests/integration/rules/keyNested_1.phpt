--TEST--
keyNested()
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$array = [
    'foo' => [
        'bar' => 123,
    ],
];

$object = new stdClass();
$object->foo = new stdClass();
$object->foo->bar = 42;

var_dump(v::keyNested('foo.bar.baz')->isValid(['foo.bar.baz' => false]));
var_dump(v::keyNested('foo.bar')->isValid($array));
var_dump(v::keyNested('foo.bar')->isValid(new ArrayObject($array)));
var_dump(v::keyNested('foo.bar', v::negative())->isValid($array));
var_dump(v::keyNested('foo.bar')->isValid($object));
var_dump(v::keyNested('foo.bar', v::stringType())->isValid($object));
var_dump(v::keyNested('foo.bar.baz', v::notEmpty(), false)->isValid($object));
?>
--EXPECTF--
bool(false)
bool(true)
bool(true)
bool(false)
bool(true)
bool(false)
bool(true)
