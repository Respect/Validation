--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::in([3, 2])->assert(1));
exceptionMessage(static fn() => v::not(v::in('foobar'))->assert('foo'));
exceptionFullMessage(static fn() => v::in([2, '1', 3], true)->assert('2'));
exceptionFullMessage(static fn() => v::not(v::in([2, '1', 3], true))->assert('1'));
?>
--EXPECT--
1 must be in `[3, 2]`
"foo" must not be in "foobar"
- "2" must be in `[2, "1", 3]`
- "1" must not be in `[2, "1", 3]`
