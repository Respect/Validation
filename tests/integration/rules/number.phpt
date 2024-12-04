--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::number()->assert(acos(1.01)));
exceptionMessage(static fn() => v::not(v::number())->assert(42));
exceptionFullMessage(static fn() => v::number()->assert(NAN));
exceptionFullMessage(static fn() => v::not(v::number())->assert(42));
?>
--EXPECT--
`NaN` must be a valid number
42 must not be a number
- `NaN` must be a valid number
- 42 must not be a number