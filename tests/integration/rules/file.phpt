--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::file()->check('tests/fixtures/non-existent.sh'));
exceptionMessage(static fn() => v::not(v::file())->check('tests/fixtures/valid-image.png'));
exceptionFullMessage(static fn() => v::file()->assert('tests/fixtures/non-existent.sh'));
exceptionFullMessage(static fn() => v::not(v::file())->assert('tests/fixtures/valid-image.png'));
?>
--EXPECT--
"tests/fixtures/non-existent.sh" must be a file
"tests/fixtures/valid-image.png" must not be a file
- "tests/fixtures/non-existent.sh" must be a file
- "tests/fixtures/valid-image.png" must not be a file
