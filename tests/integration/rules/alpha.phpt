--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::alpha()->check('aaa%a'));
exceptionMessage(static fn() => v::alpha(' ')->check('bbb%b'));
exceptionMessage(static fn() => v::not(v::alpha())->check('ccccc'));
exceptionMessage(static fn() => v::not(v::alpha('% '))->check('ddd%d'));
exceptionFullMessage(static fn() => v::alpha()->assert('eee^e'));
exceptionFullMessage(static fn() => v::not(v::alpha())->assert('fffff'));
exceptionFullMessage(static fn() => v::alpha('* &%')->assert('ggg^g'));
exceptionFullMessage(static fn() => v::not(v::alpha('^'))->assert('hhh^h'));
?>
--EXPECT--
"aaa%a" must contain only letters (a-z)
"bbb%b" must contain only letters (a-z) and " "
"ccccc" must not contain letters (a-z)
"ddd%d" must not contain letters (a-z) or "% "
- "eee^e" must contain only letters (a-z)
- "fffff" must not contain letters (a-z)
- "ggg^g" must contain only letters (a-z) and "* &%"
- "hhh^h" must not contain letters (a-z) or "^"
