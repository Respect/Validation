--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::not(v::image())->assert('tests/fixtures/valid-image.gif');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--
- "tests/fixtures/valid-image.gif" must not be a valid image
