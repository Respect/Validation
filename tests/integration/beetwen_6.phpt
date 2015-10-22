--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::not(v::intType()->between(1, 42))->assert(41);
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
--EXPECTF--
- 41 must not be lower than or equals 42
