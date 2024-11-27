--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::boolType()->check('teste'));
exceptionMessage(static fn() => v::not(v::boolType())->check(true));
exceptionFullMessage(static fn() => v::boolType()->assert([]));
exceptionFullMessage(static fn() => v::not(v::boolType())->assert(false));
?>
--EXPECT--
"teste" must be of type boolean
`true` must not be of type boolean
- `[]` must be of type boolean
- `false` must not be of type boolean
