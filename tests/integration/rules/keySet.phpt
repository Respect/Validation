--FILE--
<?php

require 'vendor/autoload.php';

$input = ['foo' => 42, 'bar' => 'String'];

$missingKeys = v::create()
    ->keySet(
        v::key('foo', v::intVal()),
        v::key('bar', v::stringType()),
        v::key('baz', v::boolType())
    );
$extraKeys = v::create()
    ->keySet(
        v::key('foo', v::intVal()),
        v::key('bar', v::stringType()),
    );
$correctStructure = v::create()
    ->keySet(
        v::key('foo', v::stringType()),
        v::key('bar', v::intType()),
    );

exceptionMessage(static fn() => $missingKeys->assert(false));
exceptionMessage(static fn() => $missingKeys->assert($input));
exceptionMessage(static fn() => $extraKeys->assert($input + ['baz' => true]));
exceptionMessage(static fn() => $correctStructure->assert($input));
exceptionFullMessage(static fn() => $missingKeys->assert(false));
exceptionFullMessage(static fn() => $missingKeys->assert($input));
exceptionFullMessage(static fn() => $extraKeys->assert($input + ['baz' => true]));
exceptionFullMessage(static fn() => $correctStructure->assert($input));
?>
--EXPECT--
`false` must be of type array
Must have keys `["baz"]` in `["foo": 42, "bar": "String"]`
Must not have keys `["baz"]` in `["foo": 42, "bar": "String", "baz": true]`
foo must be of type string
- `false` must be of type array
- Must have keys `["baz"]` in `["foo": 42, "bar": "String"]`
- Must not have keys `["baz"]` in `["foo": 42, "bar": "String", "baz": true]`
- All of the required rules must pass for `["foo": 42, "bar": "String"]`
  - foo must be of type string
  - bar must be of type integer
