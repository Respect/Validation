--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\WritableException;
use Respect\Validation\Validator as v;

try {
    v::writable()->check('/path/of/a/valid/writable/file.txt');
} catch (WritableException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::writable())->check('tests/fixtures/valid-image.png');
} catch (WritableException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::writable()->assert([]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::writable())->assert('tests/fixtures/invalid-image.png');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
"/path/of/a/valid/writable/file.txt" must be writable
"tests/fixtures/valid-image.png" must not be writable
- `{ }` must be writable
- "tests/fixtures/invalid-image.png" must not be writable
