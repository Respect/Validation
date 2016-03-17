--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NullTypeException;
use Respect\Validation\Validator as v;

try {
    v::nullType()->check(1);
} catch (NullTypeException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::nullType()->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
1 must be null
- "" must be null
