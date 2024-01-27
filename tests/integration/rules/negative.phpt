--CREDITS--
Ismael Elias <ismael.esq@hotmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::negative()->check(16));
exceptionMessage(static fn() => v::not(v::negative())->check(-10));
exceptionFullMessage(static fn() => v::negative()->assert('a'));
exceptionFullMessage(static fn() => v::not(v::negative())->assert('-144'));
?>
--EXPECT--
16 must be negative
-10 must not be negative
- "a" must be negative
- "-144" must not be negative
