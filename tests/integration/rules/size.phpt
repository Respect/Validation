--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::size('1kb', '2kb')->check('tests/fixtures/valid-image.gif'));
exceptionMessage(static fn() => v::size('700kb', null)->check('tests/fixtures/valid-image.gif'));
exceptionMessage(static fn() => v::size(null, '1kb')->check('tests/fixtures/valid-image.gif'));
exceptionMessage(static fn() => v::not(v::size('500kb', '600kb'))->check('tests/fixtures/valid-image.gif'));
exceptionMessage(static fn() => v::not(v::size('500kb', null))->check('tests/fixtures/valid-image.gif'));
exceptionMessage(static fn() => v::not(v::size(null, '600kb'))->check('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::size('1kb', '2kb')->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::size('700kb', null)->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::size(null, '1kb')->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::not(v::size('500kb', '600kb'))->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::not(v::size('500kb', null))->assert('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::not(v::size(null, '600kb'))->assert('tests/fixtures/valid-image.gif'));
?>
--EXPECT--
"tests/fixtures/valid-image.gif" must be between "1kb" and "2kb"
"tests/fixtures/valid-image.gif" must be greater than "700kb"
"tests/fixtures/valid-image.gif" must be lower than "1kb"
"tests/fixtures/valid-image.gif" must not be between "500kb" and "600kb"
"tests/fixtures/valid-image.gif" must not be greater than "500kb"
"tests/fixtures/valid-image.gif" must not be lower than "600kb"
- "tests/fixtures/valid-image.gif" must be between "1kb" and "2kb"
- "tests/fixtures/valid-image.gif" must be greater than "700kb"
- "tests/fixtures/valid-image.gif" must be lower than "1kb"
- "tests/fixtures/valid-image.gif" must not be between "500kb" and "600kb"
- "tests/fixtures/valid-image.gif" must not be greater than "500kb"
- "tests/fixtures/valid-image.gif" must not be lower than "600kb"
