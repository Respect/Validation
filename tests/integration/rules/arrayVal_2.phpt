--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ArrayValException;
use Respect\Validation\Validator as v;

try {
    v::arrayVal()->check('Bla %123');
} catch (ArrayValException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"Bla %123" must be an array
