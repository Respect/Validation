--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::stringVal()->check([]));
exceptionMessage(static fn() => v::not(v::stringVal())->check(true));
exceptionFullMessage(static fn() => v::stringVal()->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::stringVal())->assert(42));
?>
--EXPECT--
`[]` must be a string
`true` must not be string
- `stdClass {}` must be a string
- 42 must not be string
