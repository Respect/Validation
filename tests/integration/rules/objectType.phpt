--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::objectType()->assert([]));
exceptionMessage(static fn() => v::not(v::objectType())->assert(new stdClass()));
exceptionFullMessage(static fn() => v::objectType()->assert('test'));
exceptionFullMessage(static fn() => v::not(v::objectType())->assert(new ArrayObject()));
?>
--EXPECT--
`[]` must be an object
`stdClass {}` must not be an object
- "test" must be an object
- `ArrayObject { getArrayCopy() => [] }` must not be an object