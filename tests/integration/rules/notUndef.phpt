--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::notUndef()->assert(null));
exceptionMessage(static fn() => v::not(v::notUndef())->assert(0));
exceptionMessage(static fn() => v::notUndef()->setName('Field')->assert(null));
exceptionMessage(static fn() => v::not(v::notUndef()->setName('Field'))->assert([]));
exceptionFullMessage(static fn() => v::notUndef()->assert(''));
exceptionFullMessage(static fn() => v::not(v::notUndef())->assert([]));
exceptionFullMessage(static fn() => v::notUndef()->setName('Field')->assert(''));
exceptionFullMessage(static fn() => v::not(v::notUndef()->setName('Field'))->assert([]));
?>
--EXPECT--
The value must not be optional
The value must be optional
Field must not be optional
Field must be optional
- The value must not be optional
- The value must be optional
- Field must not be optional
- Field must be optional
