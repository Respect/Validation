--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::notBlank()->assert(null));
exceptionMessage(static fn() => v::notBlank()->setName('Field')->assert(null));
exceptionMessage(static fn() => v::not(v::notBlank())->assert(1));
exceptionFullMessage(static fn() => v::notBlank()->assert(''));
exceptionFullMessage(static fn() => v::notBlank()->setName('Field')->assert(''));
exceptionFullMessage(static fn() => v::not(v::notBlank())->assert([1]));
?>
--EXPECT--
The value must not be blank
Field must not be blank
1 must be blank
- The value must not be blank
- Field must not be blank
- `[1]` must be blank
