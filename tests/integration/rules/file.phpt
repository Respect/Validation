--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FileException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::file()->check('tests/fixtures/non-existent.sh');
} catch (FileException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::file())->check('tests/fixtures/valid-image.png');
} catch (FileException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::file()->assert('tests/fixtures/non-existent.sh');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::file())->assert('tests/fixtures/valid-image.png');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"tests/fixtures/non-existent.sh" must be a file
"tests/fixtures/valid-image.png" must not be a file
- "tests/fixtures/non-existent.sh" must be a file
- "tests/fixtures/valid-image.png" must not be a file
