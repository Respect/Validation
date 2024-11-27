--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::digit()->assert('abc'));
exceptionMessage(static fn() => v::digit('-')->assert('a-b'));
exceptionMessage(static fn() => v::not(v::digit())->assert('123'));
exceptionMessage(static fn() => v::not(v::digit('-'))->assert('1-3'));
exceptionFullMessage(static fn() => v::digit()->assert('abc'));
exceptionFullMessage(static fn() => v::digit('-')->assert('a-b'));
exceptionFullMessage(static fn() => v::not(v::digit())->assert('123'));
exceptionFullMessage(static fn() => v::not(v::digit('-'))->assert('1-3'));
?>
--EXPECT--
"abc" must contain only digits (0-9)
"a-b" must contain only digits (0-9) and "-"
"123" must not contain digits (0-9)
"1-3" must not contain digits (0-9) and "-"
- "abc" must contain only digits (0-9)
- "a-b" must contain only digits (0-9) and "-"
- "123" must not contain digits (0-9)
- "1-3" must not contain digits (0-9) and "-"
