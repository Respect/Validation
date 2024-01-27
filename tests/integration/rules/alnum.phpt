--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::alnum()->check('abc%1'));
exceptionMessage(static fn() => v::alnum(' ')->check('abc%2'));
exceptionMessage(static fn() => v::not(v::alnum())->check('abcd3'));
exceptionMessage(static fn() => v::not(v::alnum('% '))->check('abc%4'));
exceptionFullMessage(static fn() => v::alnum()->assert('abc^1'));
exceptionFullMessage(static fn() => v::not(v::alnum())->assert('abcd2'));
exceptionFullMessage(static fn() => v::alnum('* &%')->assert('abc^3'));
exceptionFullMessage(static fn() => v::not(v::alnum('^'))->assert('abc^4'));
?>
--EXPECT--
"abc%1" must contain only letters (a-z) and digits (0-9)
"abc%2" must contain only letters (a-z), digits (0-9) and " "
"abcd3" must not contain letters (a-z) or digits (0-9)
"abc%4" must not contain letters (a-z), digits (0-9) or "% "
- "abc^1" must contain only letters (a-z) and digits (0-9)
- "abcd2" must not contain letters (a-z) or digits (0-9)
- "abc^3" must contain only letters (a-z), digits (0-9) and "* &%"
- "abc^4" must not contain letters (a-z), digits (0-9) or "^"
