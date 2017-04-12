--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\LengthException;
use Respect\Validation\Validator as v;

try {
    v::length(5, 5)->check('123456');
} catch (LengthException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"123456" must have a length of 5
