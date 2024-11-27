--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::notEmpty()->assert(null));
exceptionMessage(static fn() => v::notEmpty()->setName('Field')->assert(null));
exceptionMessage(static fn() => v::not(v::notEmpty())->assert(1));
exceptionFullMessage(static fn() => v::notEmpty()->assert(''));
exceptionFullMessage(static fn() => v::notEmpty()->setName('Field')->assert(''));
exceptionFullMessage(static fn() => v::not(v::notEmpty())->assert([1]));
?>
--EXPECT--
The value must not be empty
Field must not be empty
1 must be empty
- The value must not be empty
- Field must not be empty
- `[1]` must be empty
