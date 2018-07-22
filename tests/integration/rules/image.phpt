--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ImageException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::image()->check('tests/fixtures/invalid-image.png');
} catch (ImageException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::image())->check('tests/fixtures/valid-image.png');
} catch (ImageException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::image()->assert(new stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::image())->assert('tests/fixtures/valid-image.gif');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"tests/fixtures/invalid-image.png" must be a valid image
"tests/fixtures/valid-image.png" must not be a valid image
- `[object] (stdClass: { })` must be a valid image
- "tests/fixtures/valid-image.gif" must not be a valid image
