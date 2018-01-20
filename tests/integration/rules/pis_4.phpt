--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\PisException;
use Respect\Validation\Validator as v;

try {
    v::not(v::pis())->check('120.6671.406-4');
} catch (PisException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"120.6671.406-4" must not be a valid PIS number
