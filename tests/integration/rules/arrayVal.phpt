--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::arrayVal()->assert('Bla %123'));
exceptionMessage(static fn() => v::not(v::arrayVal())->assert([42]));
exceptionFullMessage(static fn() => v::arrayVal()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::arrayVal())->assert(new ArrayObject([2, 3])));
?>
--EXPECT--
"Bla %123" must be an array value
`[42]` must not be an array value
- `stdClass {}` must be an array value
- `ArrayObject { getArrayCopy() => [2, 3] }` must not be an array value
