--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::not(v::between('a', 'b'))->assert('a');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
--EXPECTF--
- "a" must not be less than or equal to "b"
