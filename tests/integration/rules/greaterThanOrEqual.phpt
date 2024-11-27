--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::greaterThanOrEqual(INF)->assert(10));
exceptionMessage(static fn() => v::not(v::greaterThanOrEqual(5))->assert(INF));
exceptionFullMessage(static fn() => v::greaterThanOrEqual('today')->assert('yesterday'));
exceptionFullMessage(static fn() => v::not(v::greaterThanOrEqual('a'))->assert('z'));
?>
--EXPECT--
10 must be greater than or equal to `INF`
`INF` must not be greater than or equal to 5
- "yesterday" must be greater than or equal to "today"
- "z" must not be greater than or equal to "a"
