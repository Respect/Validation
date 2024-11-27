--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::countable()->assert(1.0));
exceptionMessage(static fn() => v::not(v::countable())->assert([]));
exceptionFullMessage(static fn() => v::countable()->assert('Not countable!'));
exceptionFullMessage(static fn() => v::not(v::countable())->assert(new ArrayObject()));
?>
--EXPECT--
1.0 must be countable
`[]` must not be countable
- "Not countable!" must be countable
- `ArrayObject { getArrayCopy() => [] }` must not be countable
