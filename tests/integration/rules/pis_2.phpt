--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\PisException;
use Respect\Validation\Validator as v;

try {
    v::pis()->check('this thing');
} catch (PisException $e) {
    echo $e->getMainMessage();
}

?>
--EXPECTF--
"this thing" must be a valid PIS number
