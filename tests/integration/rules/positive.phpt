--CREDITS--
Ismael Elias <ismael.esq@hotmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::positive()->check(-10));
exceptionMessage(static fn() => v::not(v::positive())->check(16));
exceptionFullMessage(static fn() => v::positive()->assert('a'));
exceptionFullMessage(static fn() => v::not(v::positive())->assert('165'));
?>
--EXPECT--
-10 must be positive
16 must not be positive
- "a" must be positive
- "165" must not be positive
