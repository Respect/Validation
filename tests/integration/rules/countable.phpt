--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::countable()->check(1.0));
exceptionMessage(static fn() => v::not(v::countable())->check([]));
exceptionFullMessage(static fn() => v::countable()->assert('Not countable!'));
exceptionFullMessage(static fn() => v::not(v::countable())->assert(new ArrayObject()));
?>
--EXPECT--
1.0 must be countable
`[]` must not be countable
- "Not countable!" must be countable
- `ArrayObject { getArrayCopy() => [] }` must not be countable
