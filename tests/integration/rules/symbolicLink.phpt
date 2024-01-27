--CREDITS--
Gus Antoniassi <gus.antoniassi@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::symbolicLink()->check('tests/fixtures/fake-filename'));
exceptionMessage(static fn() => v::not(v::symbolicLink())->check('tests/fixtures/symbolic-link'));
exceptionFullMessage(static fn() => v::symbolicLink()->assert('tests/fixtures/fake-filename'));
exceptionFullMessage(static fn() => v::not(v::symbolicLink())->assert('tests/fixtures/symbolic-link'));
?>
--EXPECT--
"tests/fixtures/fake-filename" must be a symbolic link
"tests/fixtures/symbolic-link" must not be a symbolic link
- "tests/fixtures/fake-filename" must be a symbolic link
- "tests/fixtures/symbolic-link" must not be a symbolic link
