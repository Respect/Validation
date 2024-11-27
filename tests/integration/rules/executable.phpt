--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::executable()->assert('bar'));
exceptionMessage(static fn() => v::not(v::executable())->assert('tests/fixtures/executable'));
exceptionFullMessage(static fn() => v::executable()->assert('bar'));
exceptionFullMessage(static fn() => v::not(v::executable())->assert('tests/fixtures/executable'));
?>
--EXPECT--
"bar" must be an executable file
"tests/fixtures/executable" must not be an executable file
- "bar" must be an executable file
- "tests/fixtures/executable" must not be an executable file
