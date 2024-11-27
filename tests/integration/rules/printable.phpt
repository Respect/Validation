--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::printable()->assert(''));
exceptionMessage(static fn() => v::not(v::printable())->assert('abc'));
exceptionFullMessage(static fn() => v::printable()->assert('foo' . chr(10) . 'bar'));
exceptionFullMessage(static fn() => v::not(v::printable())->assert('$%asd'));
?>
--EXPECT--
"" must contain only printable characters
"abc" must not contain printable characters
- "foo\nbar" must contain only printable characters
- "$%asd" must not contain printable characters
