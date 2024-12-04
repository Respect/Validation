--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::countable()->assert(1.0));
exceptionMessage(static fn() => v::not(v::countable())->assert([]));
exceptionFullMessage(static fn() => v::countable()->assert('Not countable!'));
exceptionFullMessage(static fn() => v::not(v::countable())->assert(new ArrayObject()));
?>
--EXPECT--
1.0 must be a countable value
`[]` must not be a countable value
- "Not countable!" must be a countable value
- `ArrayObject { getArrayCopy() => [] }` must not be a countable value