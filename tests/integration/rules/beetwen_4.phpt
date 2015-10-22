--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::between('a', 'b')->assert('c');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
--EXPECTF--
- "c" must be lower than or equals "b"
