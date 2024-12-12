--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::size('KB', v::between(1, 2))->assert('tests/fixtures/valid-image.gif'));
exceptionMessage(static fn() => v::size('KB', v::greaterThan(700))->assert('tests/fixtures/valid-image.gif'));
exceptionMessage(static fn() => v::size('KB', v::lessThan(1))->assert('tests/fixtures/valid-image.gif'));
exceptionMessage(static fn() => v::not(v::size('KB', v::between(500, 600)))->assert('tests/fixtures/valid-image.gif'));
exceptionMessage(static fn() => v::not(v::size('KB', v::greaterThan(500)))->assert('tests/fixtures/valid-image.gif'));
exceptionMessage(static fn() => v::not(v::size('KB', v::lessThan(600)))->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::size('KB', v::between(1, 2))->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::size('KB', v::greaterThan(700))->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::size('KB', v::lessThan(1))->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::not(v::size('KB', v::between(500, 600)))->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::not(v::size('KB', v::greaterThan(500)))->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::not(v::size('KB', v::lessThan(600)))->assert('tests/fixtures/valid-image.gif'));
?>
--EXPECT--
The size in kilobytes of "tests/fixtures/valid-image.gif" must be between 1 and 2
The size in kilobytes of "tests/fixtures/valid-image.gif" must be greater than 700
The size in kilobytes of "tests/fixtures/valid-image.gif" must be less than 1
The size in kilobytes of "tests/fixtures/valid-image.gif" must not be between 500 and 600
The size in kilobytes of "tests/fixtures/valid-image.gif" must not be greater than 500
The size in kilobytes of "tests/fixtures/valid-image.gif" must not be less than 600
- The size in kilobytes of "tests/fixtures/valid-image.gif" must be between 1 and 2
- The size in kilobytes of "tests/fixtures/valid-image.gif" must be greater than 700
- The size in kilobytes of "tests/fixtures/valid-image.gif" must be less than 1
- The size in kilobytes of "tests/fixtures/valid-image.gif" must not be between 500 and 600
- The size in kilobytes of "tests/fixtures/valid-image.gif" must not be greater than 500
- The size in kilobytes of "tests/fixtures/valid-image.gif" must not be less than 600
