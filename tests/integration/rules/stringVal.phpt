--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::stringVal()->assert([]));
exceptionMessage(static fn() => v::not(v::stringVal())->assert(true));
exceptionFullMessage(static fn() => v::stringVal()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::stringVal())->assert(42));
?>
--EXPECT--
`[]` must be a string value
`true` must not be a string value
- `stdClass {}` must be a string value
- 42 must not be a string value