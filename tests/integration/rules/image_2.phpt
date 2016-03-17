--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ImageException;
use Respect\Validation\Validator as v;

try {
    v::image()->check('tests/fixtures/invalid-image.png');
} catch (ImageException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"tests/fixtures/invalid-image.png" must be a valid image
