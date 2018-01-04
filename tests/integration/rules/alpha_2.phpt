--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\AlphaException;
use Respect\Validation\Validator as v;

try {
    v::alpha()->assert(1);
} catch (AlphaException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::alpha()->assertAll(2);
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
1 must contain only letters (a-z)
- 2 must contain only letters (a-z)
