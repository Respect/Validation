--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::age(10, 50)->assert('9 years ago');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}

?>
--EXPECTF--
- "9 years ago" must be less than or equal to "%d-%d-%d %d:%d:%d"
