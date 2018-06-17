--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ExistsException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::exists()->check('/path/of/a/non-existent/file');
} catch (ExistsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::exists())->check('tests/fixtures/valid-image.gif');
} catch (ExistsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::exists()->assert('/path/of/a/non-existent/file');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::exists())->assert('tests/fixtures/valid-image.png');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"/path/of/a/non-existent/file" must exists
"tests/fixtures/valid-image.gif" must not exists
- "/path/of/a/non-existent/file" must exists
- "tests/fixtures/valid-image.png" must not exists
