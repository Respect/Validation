--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::age(10, 50)->assert('9 years ago');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}

?>
--EXPECTF--
- "9 years ago" must be less than or equal to "2005-11-09 23:59:59"
