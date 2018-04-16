--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NifException;
use Respect\Validation\Validator as v;

try {
    v::not(v::nif())->check('71110316C');
} catch (NifException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"71110316C" must not be a NIF
