--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::startsWith('b')->assert(['a', 'b']));
exceptionMessage(static fn() => v::not(v::startsWith(1.1))->assert([1.1, 2.2]));
exceptionFullMessage(static fn() => v::startsWith('3.3', true)->assert([3.3, 4.4]));
exceptionFullMessage(static fn() => v::not(v::startsWith('c'))->assert(['c', 'd']));
?>
--EXPECT--
`["a", "b"]` must start with "b"
`[1.1, 2.2]` must not start with 1.1
- `[3.3, 4.4]` must start with "3.3"
- `["c", "d"]` must not start with "c"
