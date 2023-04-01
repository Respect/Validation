--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::exists()->check('/path/of/a/non-existent/file'));
exceptionMessage(static fn() => v::not(v::exists())->check('tests/fixtures/valid-image.gif'));
exceptionFullMessage(static fn() => v::exists()->assert('/path/of/a/non-existent/file'));
exceptionFullMessage(static fn() => v::not(v::exists())->assert('tests/fixtures/valid-image.png'));
?>
--EXPECT--
"/path/of/a/non-existent/file" must exist
"tests/fixtures/valid-image.gif" must not exist
- "/path/of/a/non-existent/file" must exist
- "tests/fixtures/valid-image.png" must not exist
