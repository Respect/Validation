--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::control()->check('16-50'));
exceptionMessage(static fn() => v::control('16')->check('16-50'));
exceptionMessage(static fn() => v::not(v::control())->check("\n"));
exceptionMessage(static fn() => v::not(v::control('16'))->check("16\n"));
exceptionFullMessage(static fn() => v::control()->assert('Foo'));
exceptionFullMessage(static fn() => v::control('Bar')->assert('Foo'));
exceptionFullMessage(static fn() => v::not(v::control())->assert("\n"));
exceptionFullMessage(static fn() => v::not(v::control('Bar'))->assert("Bar\n"));
?>
--EXPECT--
"16-50" must contain only control characters
"16-50" must contain only control characters and "16"
"\n" must not contain control characters
"16\n" must not contain control characters or "16"
- "Foo" must contain only control characters
- "Foo" must contain only control characters and "Bar"
- "\n" must not contain control characters
- "Bar\n" must not contain control characters or "Bar"
