--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::iterableVal()->check(3));
exceptionMessage(static fn() => v::not(v::iterableVal())->check([2, 3]));
exceptionFullMessage(static fn() => v::iterableVal()->assert('String'));
exceptionFullMessage(static fn() => v::not(v::iterableVal())->assert(new stdClass()));
?>
--EXPECT--
3 must be iterable
`[2, 3]` must not be iterable
- "String" must be iterable
- `stdClass {}` must not be iterable
