--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\MimetypeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::mimetype('image/png')->check('image.png');
} catch (MimetypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::mimetype('image/png'))->check('tests/fixtures/valid-image.png');
} catch (MimetypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::mimetype('image/png')->assert('tests/fixtures/invalid-image.png');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::mimetype('image/png'))->assert('tests/fixtures/valid-image.png');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"image.png" must have "image/png" MIME type
"tests/fixtures/valid-image.png" must not have "image/png" MIME type
- "tests/fixtures/invalid-image.png" must have "image/png" MIME type
- "tests/fixtures/valid-image.png" must not have "image/png" MIME type
