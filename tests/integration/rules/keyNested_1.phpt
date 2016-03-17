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

var_dump(v::keyNested('foo.bar.baz')->validate(['foo.bar.baz' => false]));
var_dump(v::keyNested('foo.bar')->validate($array));
var_dump(v::keyNested('foo.bar')->validate(new ArrayObject($array)));
var_dump(v::keyNested('foo.bar', v::negative())->validate($array));
var_dump(v::keyNested('foo.bar')->validate($object));
var_dump(v::keyNested('foo.bar', v::stringType())->validate($object));
var_dump(v::keyNested('foo.bar.baz', v::notEmpty(), false)->validate($object));
?>
--EXPECTF--
bool(false)
bool(true)
bool(true)
bool(false)
bool(true)
bool(false)
bool(true)
