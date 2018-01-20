--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NifException;
use Respect\Validation\Validator as v;

try {
    v::nif()->check('06357771Q');
} catch (NifException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"06357771Q" must be a NIF
