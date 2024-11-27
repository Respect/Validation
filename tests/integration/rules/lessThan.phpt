--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::lessThan(12)->assert(21));
exceptionMessage(static fn() => v::not(v::lessThan('today'))->assert('yesterday'));
exceptionFullMessage(static fn() => v::lessThan('1988-09-09')->assert('2018-09-09'));
exceptionFullMessage(static fn() => v::not(v::lessThan('b'))->assert('a'));
?>
--EXPECT--
21 must be less than 12
"yesterday" must not be less than "today"
- "2018-09-09" must be less than "1988-09-09"
- "a" must not be less than "b"
