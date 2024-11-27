--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::greaterThan(21)->assert(12));
exceptionMessage(static fn() => v::not(v::greaterThan('yesterday'))->assert('today'));
exceptionFullMessage(static fn() => v::greaterThan('2018-09-09')->assert('1988-09-09'));
exceptionFullMessage(static fn() => v::not(v::greaterThan('a'))->assert('ba'));
?>
--EXPECT--
12 must be greater than 21
"today" must not be greater than "yesterday"
- "1988-09-09" must be greater than "2018-09-09"
- "ba" must not be greater than "a"
