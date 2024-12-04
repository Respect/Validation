--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::lessThanOrEqual(10)->assert(11));
exceptionMessage(static fn() => v::not(v::lessThanOrEqual(10))->assert(5));
exceptionFullMessage(static fn() => v::lessThanOrEqual('today')->assert('tomorrow'));
exceptionFullMessage(static fn() => v::not(v::lessThanOrEqual('b'))->assert('a'));
?>
--EXPECT--
11 must be less than or equal to 10
5 must be greater than 10
- "tomorrow" must be less than or equal to "today"
- "a" must be greater than "b"