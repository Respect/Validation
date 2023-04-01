--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::iterableType()->check(3));
exceptionMessage(static fn() => v::not(v::iterableType())->check([2, 3]));
exceptionFullMessage(static fn() => v::iterableType()->assert('String'));
exceptionFullMessage(static fn() => v::not(v::iterableType())->assert(new stdClass()));
?>
--EXPECT--
3 must be iterable
`{ 2, 3 }` must not be iterable
- "String" must be iterable
- `[object] (stdClass: { })` must not be iterable
