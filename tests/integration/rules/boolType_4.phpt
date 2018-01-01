--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\BoolTypeException;
use Respect\Validation\Validator as v;

try {
    v::not(v::boolType())->check(true);
} catch (BoolTypeException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
`TRUE` must not be a boolean
