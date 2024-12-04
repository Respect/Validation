--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::arrayType()->assert('teste'));
exceptionMessage(static fn() => v::not(v::arrayType())->assert([]));
exceptionFullMessage(static fn() => v::arrayType()->assert(new ArrayObject()));
exceptionFullMessage(static fn() => v::not(v::arrayType())->assert([1, 2, 3]));
?>
--EXPECT--
"teste" must be an array
`[]` must not be an array
- `ArrayObject { getArrayCopy() => [] }` must be an array
- `[1, 2, 3]` must not be an array