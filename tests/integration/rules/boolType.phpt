--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::boolType()->assert('teste'));
exceptionMessage(static fn() => v::not(v::boolType())->assert(true));
exceptionFullMessage(static fn() => v::boolType()->assert([]));
exceptionFullMessage(static fn() => v::not(v::boolType())->assert(false));
?>
--EXPECT--
"teste" must be a boolean
`true` must not be a boolean
- `[]` must be a boolean
- `false` must not be a boolean