--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::writable()->check('/path/of/a/valid/writable/file.txt'));
exceptionMessage(static fn() => v::not(v::writable())->check('tests/fixtures/valid-image.png'));
exceptionFullMessage(static fn() => v::writable()->assert([]));
exceptionFullMessage(static fn() => v::not(v::writable())->assert('tests/fixtures/invalid-image.png'));
?>
--EXPECT--
"/path/of/a/valid/writable/file.txt" must be writable
"tests/fixtures/valid-image.png" must not be writable
- `{ }` must be writable
- "tests/fixtures/invalid-image.png" must not be writable
