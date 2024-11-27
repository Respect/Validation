--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::symbolicLink()->assert('tests/fixtures/fake-filename'));
exceptionMessage(static fn() => v::not(v::symbolicLink())->assert('tests/fixtures/symbolic-link'));
exceptionFullMessage(static fn() => v::symbolicLink()->assert('tests/fixtures/fake-filename'));
exceptionFullMessage(static fn() => v::not(v::symbolicLink())->assert('tests/fixtures/symbolic-link'));
?>
--EXPECT--
"tests/fixtures/fake-filename" must be a symbolic link
"tests/fixtures/symbolic-link" must not be a symbolic link
- "tests/fixtures/fake-filename" must be a symbolic link
- "tests/fixtures/symbolic-link" must not be a symbolic link
