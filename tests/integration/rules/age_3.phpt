--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::age(18)->assertAll('17 years ago');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}

?>
--EXPECTF--
- "17 years ago" must be less than or equal to `[date-time] (DateTime: "%s")`
