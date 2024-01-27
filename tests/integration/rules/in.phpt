--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::in([3, 2])->check(1));
exceptionMessage(static fn() => v::not(v::in('foobar'))->check('foo'));
exceptionFullMessage(static fn() => v::in([2, '1', 3], true)->assert('2'));
exceptionFullMessage(static fn() => v::not(v::in([2, '1', 3], true))->assert('1'));
?>
--EXPECT--
1 must be in `{ 3, 2 }`
"foo" must not be in "foobar"
- "2" must be in `{ 2, "1", 3 }`
- "1" must not be in `{ 2, "1", 3 }`
