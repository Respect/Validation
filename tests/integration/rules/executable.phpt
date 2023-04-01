--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::executable()->check('bar'));
exceptionMessage(static fn() => v::not(v::executable())->check('tests/fixtures/executable'));
exceptionFullMessage(static fn() => v::executable()->assert('bar'));
exceptionFullMessage(static fn() => v::not(v::executable())->assert('tests/fixtures/executable'));
?>
--EXPECT--
"bar" must be an executable file
"tests/fixtures/executable" must not be an executable file
- "bar" must be an executable file
- "tests/fixtures/executable" must not be an executable file
