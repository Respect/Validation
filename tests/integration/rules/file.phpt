--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FileException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::file()->check('tests/fixtures');
} catch (FileException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::file())->check('tests/fixtures/valid-image.png');
} catch (FileException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::file()->assert([]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::file())->assert('tests/fixtures/invalid-image.png');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"tests/fixtures" must be a file
"tests/fixtures/valid-image.png" must not be a file
- `{ }` must be a file
- "tests/fixtures/invalid-image.png" must not be a file