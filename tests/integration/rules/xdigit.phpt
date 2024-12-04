--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::xdigit()->assert('aaa%a'));
exceptionMessage(static fn() => v::xdigit(' ')->assert('bbb%b'));
exceptionMessage(static fn() => v::not(v::xdigit())->assert('ccccc'));
exceptionMessage(static fn() => v::not(v::xdigit('% '))->assert('ddd%d'));
exceptionFullMessage(static fn() => v::xdigit()->assert('eee^e'));
exceptionFullMessage(static fn() => v::not(v::xdigit())->assert('fffff'));
exceptionFullMessage(static fn() => v::xdigit('* &%')->assert('000^0'));
exceptionFullMessage(static fn() => v::not(v::xdigit('^'))->assert('111^1'));
?>
--EXPECT--
"aaa%a" must only contain hexadecimal digits
"bbb%b" must contain hexadecimal digits and " "
"ccccc" must not only contain hexadecimal digits
"ddd%d" must not contain hexadecimal digits or "% "
- "eee^e" must only contain hexadecimal digits
- "fffff" must not only contain hexadecimal digits
- "000^0" must contain hexadecimal digits and "* &%"
- "111^1" must not contain hexadecimal digits or "^"