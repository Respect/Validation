--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\MaxException;

try {
    v::age(18)->check('17 years ago');
} catch (MaxException $e) {
    echo $e->getMainMessage();
}

?>
--EXPECTF--
"17 years ago" must be less than or equal to "%d-%d-%d %d:%d:%d"
