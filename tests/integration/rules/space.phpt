--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::space()->check('ab'));
exceptionMessage(static fn() => v::space('c')->check('cd'));
exceptionMessage(static fn() => v::not(v::space())->check("\t"));
exceptionMessage(static fn() => v::not(v::space('def'))->check("\r"));
exceptionFullMessage(static fn() => v::space()->assert('ef'));
exceptionFullMessage(static fn() => v::space('e')->assert('gh'));
exceptionFullMessage(static fn() => v::not(v::space())->assert("\n"));
exceptionFullMessage(static fn() => v::not(v::space('yk'))->assert(' k'));
?>
--EXPECT--
"ab" must contain only space characters
"cd" must contain only space characters and "c"
"\t" must not contain space characters
"\r" must not contain space characters or "def"
- "ef" must contain only space characters
- "gh" must contain only space characters and "e"
- "\n" must not contain space characters
- " k" must not contain space characters or "yk"
