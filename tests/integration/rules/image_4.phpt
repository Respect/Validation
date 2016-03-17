--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ImageException;
use Respect\Validation\Validator as v;

try {
    v::not(v::image())->check('tests/fixtures/valid-image.png');
} catch (ImageException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"tests/fixtures/valid-image.png" must not be a valid image
