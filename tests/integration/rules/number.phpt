--CREDITS--
Ismael Elias <ismael.esq@hotmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::number()->check(acos(1.01)));
exceptionMessage(static fn() => v::not(v::number())->check(42));
exceptionFullMessage(static fn() => v::number()->assert(NAN));
exceptionFullMessage(static fn() => v::not(v::number())->assert(42));
?>
--EXPECT--
`NaN` must be a number
42 must not be a number
- `NaN` must be a number
- 42 must not be a number
