--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::iterableVal()->assert(3));
exceptionMessage(static fn() => v::not(v::iterableVal())->assert([2, 3]));
exceptionFullMessage(static fn() => v::iterableVal()->assert('String'));
exceptionFullMessage(static fn() => v::not(v::iterableVal())->assert(new stdClass()));
?>
--EXPECT--
3 must be an iterable value
`[2, 3]` must not be an iterable value
- "String" must be an iterable value
- `stdClass {}` must not be an iterable value