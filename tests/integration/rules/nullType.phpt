--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::nullType()->assert(''));
exceptionMessage(static fn() => v::not(v::nullType())->assert(null));
exceptionFullMessage(static fn() => v::nullType()->assert(false));
exceptionFullMessage(static fn() => v::not(v::nullType())->assert(null));
?>
--EXPECT--
"" must be null
`null` must not be null
- `false` must be null
- `null` must not be null
