--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::scalarVal()->assert([]));
exceptionMessage(static fn() => v::not(v::scalarVal())->assert(true));
exceptionFullMessage(static fn() => v::scalarVal()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::scalarVal())->assert(42));
?>
--EXPECT--
`[]` must be a scalar value
`true` must not be a scalar value
- `stdClass {}` must be a scalar value
- 42 must not be a scalar value
