--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::floatType()->check('42.33'));
exceptionMessage(static fn() => v::not(v::floatType())->check(INF));
exceptionFullMessage(static fn() => v::floatType()->assert(true));
exceptionFullMessage(static fn() => v::not(v::floatType())->assert(2.0));
?>
--EXPECT--
"42.33" must be of type float
`INF` must not be of type float
- `true` must be of type float
- 2.0 must not be of type float
