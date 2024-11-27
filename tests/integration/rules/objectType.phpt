--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::objectType()->assert([]));
exceptionMessage(static fn() => v::not(v::objectType())->assert(new stdClass()));
exceptionFullMessage(static fn() => v::objectType()->assert('test'));
exceptionFullMessage(static fn() => v::not(v::objectType())->assert(new ArrayObject()));
?>
--EXPECT--
`[]` must be of type object
`stdClass {}` must not be of type object
- "test" must be of type object
- `ArrayObject { getArrayCopy() => [] }` must not be of type object
