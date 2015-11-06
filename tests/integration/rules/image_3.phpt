--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::image()->assert(new stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--
- `[object] (stdClass: { })` must be a valid image
